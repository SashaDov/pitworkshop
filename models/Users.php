<?php
/**
 * Created by PhpStorm.
 * User: Galina
 * Date: 24.10.2017
 * Time: 18:51
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Users extends ActiveRecord implements IdentityInterface
{


    //public static function tableName()
    //{
    //    return 'users';
    //}

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
       // return static::findOne(['accessToken' => $token]);
    }

    //public static function findByUsername ($username)
    //{
    //    return self::findOne($username);
    //}

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        //return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
       // return $this->getAuthKey() === $authKey;
    }

    public function validatePassword ($password)
    {
        return $this->password === $password;
    }
}