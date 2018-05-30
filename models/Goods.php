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
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
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
        if ($this->imageFile instanceof UploadedFile) {
            $this->imageFile->saveAs('img/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $this->upload();
            //var_dump('dfasfasfas');die;

        return parent::save($runValidation, $attributeNames);
    }
}