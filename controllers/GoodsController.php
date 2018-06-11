<?php
namespace app\controllers;

use app\models\File;
use app\models\Goods;
use app\models\Lang;
use function GuzzleHttp\Psr7\str;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class GoodsController extends Controller
{
    public $layout = 'master';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


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
        $model = Goods::findOne($id);
        $files = $model->files;
        $srcs = [];
        foreach ($files as $file) {
            $f = new File();
            $srcs[] = $f->getFileRealPath($file->entity_type, $file->document);
        }
        $langs = [];
        foreach ($model->langAttributes() as $attribute) {
            $langs[] = $model->getLang($attribute)->one();
        }
        return $this->render('show', ['model' => $model, 'srcs' => $srcs, 'langs' => $langs]);
    }
}