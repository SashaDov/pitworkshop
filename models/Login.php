<?php
namespace app\models;

use yii\base\Model;

/**
 * Class Login
 * @package app\models
 *
 *
 */
class Login extends Model
{

    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function getUser()
    {
        return Users::findOne(['username' => $this->username]);
    }
}
