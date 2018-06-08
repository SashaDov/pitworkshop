<?php
/**
 * Created by PhpStorm.
 * User: Galina
 * Date: 26.03.2018
 * Time: 20:57
 */

namespace app\models;

use app\common\AppModel;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class File extends AppModel//ActiveRecord //extends Model
{
    public static function tableName(){
        return '{{files}}';
    }

    public function rules()
    {
        return [
        ];
    }

    public function upload(UploadedFile $file, $entityId, $entityType)
    {
        $this->entity_type = $entityType;
        $this->entity_id = $entityId;
        do {
            $filename = $this->generateFileName($file);
            FileHelper::createDirectory($this->getFileEntityRealPath($entityType), 0777, true);
            $filepath = $this->getFileEntityRealPath($entityType) . DIRECTORY_SEPARATOR . $filename;
        }  while (file_exists($filepath));
        $this->document = $filename;

        $file->saveAs($filepath);

        if ($this->validate()) {
            $this->save(false);
        }
    }

    protected function generateFileName(UploadedFile $originalName)
    {
        $strFromFile = $originalName->tempName . date('YmdHis');
        $fileName = sha1(\Yii::$app->getSecurity()->generateRandomString(10)) . sha1($strFromFile) . '.' . $originalName->extension;
        return $fileName;
    }

    public function getFileEntityRealPath($entityType)
    {
        return \Yii::$app->getBasePath() .
            DIRECTORY_SEPARATOR . 'uploads' .
            DIRECTORY_SEPARATOR . $entityType;
    }
}
