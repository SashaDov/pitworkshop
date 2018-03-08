<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Goods extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public static function tableName()
    {
        return '{{goods}}';
    }

    public function rules()
    {
        return [
            [['title', 'alias', 'description', 'materials', 'tags', 'service_recomendation', 'size'], 'string'],
            //[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['category', 'chapter', 'work_duration'], 'integer'],
            [['price'], 'double'],
            [['date_start', 'date_end', 'date_order'], 'date', 'format' => 'php:Y-m-d'],
            [['date_start', 'date_end', 'date_order'], 'default', 'value' => date('Y-m-d')],
            [['alias'], 'unique'],
            [['title', 'alias', 'category', 'chapter'], 'required'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('/img/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}