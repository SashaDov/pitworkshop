<?php
namespace app\models;

use app\common\AppModel;

class Lang extends AppModel
{
    public static function tableName(){
        return '{{lang}}';
    }

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'entity_type', 'en', 'ru', 'de', 'fr'], 'string'],
        ];
    }

    public function record($key, $record)
    {
        $language = \Yii::$app->language;
        $this->{$language} = $record;
        $this->entity_type = $key;
        $this->save();
        return $this->id;
    }

    public function editRecord($record)
    {
        $language = \Yii::$app->language;
        $this->{$language} = $record;
        $this->save();
    }

    public function getGood($attr = 'title')
    {
        return $this->hasOne(Goods::class, [$attr => 'id']);
    }
}