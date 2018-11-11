<?php
namespace app\models;

use app\common\AppModel;

class Currency extends AppModel
{
    public static function tableName(){
        return '{{currency}}';
    }

    public function rules()
    {
        return [
            [['id', 'vchcode', 'vcode', 'vnom', 'vcurs', 'vname'], 'string'],
            [['date_created'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }
}
