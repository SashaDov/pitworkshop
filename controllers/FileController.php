<?php
namespace app\controllers;

use app\models\File;
use yii\web\Controller;

class FileController extends Controller
{
    public function actionDeleteFile($id)
    {
        $model = File::findOne($id);
        $path = $model->getFileRealPath();
        $entityType = $model->entity_type;
        $entityId = $model->entity_id;
        if (file_exists($path)) {
            unlink($path);
        }
        $model->delete();
        return $this->redirect(['/' . $entityType . '/edit-image', 'id' => $entityId]);
    }
}