<?php
namespace app\models;

use app\common\AppModel;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Goods extends AppModel
{
    /**
     * @var
     */
    public $records;
    /**
     * @var UploadedFile[]
     */
    public $documents;


    public static function tableName()
    {
        return '{{goods}}';
    }

    public function rules()
    {
        return [
            [['title', 'alias', 'description', 'materials', 'tags', 'service_recomendation', 'size'], 'string'],
            [['documents'], 'file', 'skipOnEmpty' => false, 'extensions' => 'doc, docx, jpg, png, pdf', 'maxFiles' => 7],
            [['category', 'chapter', 'work_duration'], 'integer'],
            [['price'], 'double'],
            [['date_start', 'date_end', 'date_order'], 'date', 'format' => 'php:Y-m-d'],
            [['date_start', 'date_end', 'date_order'], 'default', 'value' => date('Y-m-d')],
            [['alias'], 'unique'],
            [['alias', 'category', 'chapter'], 'required'],
            [['records'], 'validateRecords'],
        ];
    }

    public function validateRecords($attribute)
    {
        foreach ($this->{$attribute} as $record) {
            if(!is_string($record)) {
                return false;
            }
        }
        return true;
    }

    public function attributeLabels()
    {
        return [
            'title' => \Yii::t('app', 'Title'),
            'description' => \Yii::t('app', 'Description'),
        ];
    }

//    public function upload()
//    {
//        if ($this->imageFile instanceof UploadedFile) {
//            $this->imageFile->saveAs('img/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
//            return true;
//        } else {
//            return false;
//        }
//    }

//    public function save($runValidation = true, $attributeNames = null)
//    {
//        $this->upload();
//            //var_dump('dfasfasfas');die;
//
//        return parent::save($runValidation, $attributeNames);
//    }
}