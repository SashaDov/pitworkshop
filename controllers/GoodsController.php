<?php
namespace app\controllers;

use app\models\Goods;
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
            'defaultPageSize' => 6,
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
        $model = new Goods();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            //var_dump($model->imageFile);
//            if ($model->upload()) {
//                //
//                return 'file is uploaded successfully';
//            }
        $model->load(Yii::$app->request->post());

        if($model->save()) {
                return $this->redirect(['goods/index']);
            } else {
                return $this->render('create', ['goods_model' => $model]);
            }
        }
        return $this->render('create', ['goods_model' => $model]);

    }

    public function actionUpload()
    {
        $model = new Goods();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                return $this->redirect(['goods/index']);
            }
        }
        return $this->render('upload', ['goods_model' => $model]);
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