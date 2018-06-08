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
            [['uuid'], 'required'],
            [['uuid', 'entity_type', 'en', 'ru', 'de', 'fr'], 'string'],
        ];
    }

    public function record($key, $record)
    {
        $language = \Yii::$app->language;
        $this->{$language} = $record;
        $this->entity_type = $key;
        $this->save();
        return $this->uuid;
    }
}