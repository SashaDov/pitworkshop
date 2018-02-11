<?php
namespace app\controllers;

use app\models\Goods;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class GoodsController extends Controller
{
    public $layout = 'master';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        var_dump(Yii::$app->request->post());die;
        $model = new Goods();
//        if (Yii::$app->request->isPost) {
//            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
//            if ($model->upload()) {
//                //
//                return 'file is uploaded successfully';
//            }
//        }
        if($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['goods/index']);
        } else {
            return $this->render('create', ['goods_model' => $model]);
        }
    }
}