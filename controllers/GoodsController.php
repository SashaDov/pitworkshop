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
                'only' => ['create', 'edit', 'edit-image', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'edit', 'edit-image', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        if (Yii::$app->request->get('category')) {
            $category = Yii::$app->request->get('category');
            $query = Goods::find()->where(['category' => $category]);
        } elseif (Yii::$app->request->get('rubric')) {
            $rubric = Yii::$app->request->get('rubric');
            $query = Goods::find()->where(['rubric' => $rubric]);
        } elseif (Yii::$app->request->get('chapter')) {
            $chapter = Yii::$app->request->get('chapter');
            $query = Goods::find()->where(['chapter' => $chapter]);
        } else {
            $query = Goods::find();
        }
        $countQuery = clone $query;
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $countQuery->count(),
        ]);

        $links = $query->orderBy('alias')
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
                return $this->redirect(['/goods/show', 'id' => $goods->id]);
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
            $srcs[] = $file->getFileRealPath();
        }
        $langs = [];
        foreach ($model->langAttributes() as $attribute) {
            $langs[$attribute] = $model->getLang($attribute)->one();
        }
        return $this->render('show', ['model' => $model, 'srcs' => $srcs, 'langs' => $langs]);
    }

    /**
     * Редактирование без изменения файловой системы
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $language = \Yii::$app->language;
        $model = Goods::findOne($id);
        foreach ($model->langAttributes() as $attribute) {
            $model->records[$attribute] = $model->getLang($attribute)->one()->{$language};
        }
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->getBodyParams();
            if ($model->load($data)) {
                $model->validate();
                foreach ($model->records as $key => $record) {
                    $id = $model->{$key};
                    $lang = Lang::findOne($id);
                    $lang->editRecord($record);
                }
                $model->save(false);
                return $this->redirect(['/goods/show', 'id' => $model->id]);
            }
        }

        return $this->render('edit', ['goods_model' => $model]);
    }

    public function actionEditImage($id)
    {
        $model = Goods::findOne($id);
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->getBodyParams();
            if ($model->load($data)) {
                $model->validate();
                $files = UploadedFile::getInstances($model, 'documents');
                if ($files) {
                    foreach ($files as $file) {
                        $fileModel = new File();
                        $fileModel->upload($file, $model->id, $model::getTableSchema()->name);
                    }
                }
                $model->save(false);
                return $this->redirect(['/goods/edit-image', 'id' => $model->id]);
            }
        }
        $files = $model->files;
        $srcs = [];
        foreach ($files as $file) {
            $srcs[$file->id] = $file->getFileRealPath();
        }
        return $this->render('edit-image', ['model' => $model, 'srcs' => $srcs]);
    }

    public function actionDelete($id){
        $model = Goods::findOne($id);
        $files = $model->files;
        foreach ($files as $file) {
            $path = $file->getFileRealPath();
            if (file_exists($path)) {
                unlink($path);
            }
            $file->delete();
        }
        foreach ($model->langAttributes() as $attribute) {
            $lang = $model->getLang($attribute)->one();
            $lang->delete();
        }
        $model->delete();
        return $this->redirect('/goods/index');
    }
}