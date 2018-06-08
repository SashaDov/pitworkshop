<?php
namespace app\controllers;

use app\models\File;
use app\models\Goods;
use app\models\Lang;
use yii\data\Pagination;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class GoodsController extends Controller
{
    public $layout = 'master';

    public function actionIndex()
    {
        $query = Goods::find();
        $countQuery = clone $query;
        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $countQuery->count(),
        ]);

        $links = $query->orderBy('title')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'links' => $links,
            'pagination' => $pagination,
        ]);
        //return $this->render('index');
    }

    public function actionCreate()
    {
        $goods = new Goods();
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->getBodyParams();
            if ($goods->load($data)) {
                $goods->validate();
                foreach ($goods->records as $key => $record) {
                    $lang = new Lang();
                    $id = $lang->record($key, $record);
                    $goods->{$key} = $id;
                }
                $files = UploadedFile::getInstances($goods, 'documents');
                if ($files) {
                    foreach ($files as $file) {
                        $fileModel = new File();
                        $fileModel->upload($file, $goods->uuid, $goods::getTableSchema()->name);
                    }
                }
                $goods->save(false);
                    return $this->refresh();
            }
        }
        return $this->render('create', [
            'goods_model' => $goods,
        ]);
    }

    public function actionShow($id)
    {
        echo $id;
        //$id = 5;
        //$id = Yii::$app->request->get('id');
        var_dump($id);die();
        $model = Goods::findOne($param);
        return $this->render('show', ['model' => $model]);
    }
}