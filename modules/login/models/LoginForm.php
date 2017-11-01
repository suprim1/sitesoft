<?php

namespace app\modules\login\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $login;
    public $password;
    public $rememberMe = true;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'trim'],
            ['login', 'string', 'length' => [3, 24]],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword ($attribute, $params)
    {
        if (!$this->hasErrors()){
            $user = $this->getUser();
            //$hash_pass=Yii::$app->getSecurity()->generatePasswordHash('123');// Генерирует хеш
            if(!$user || !Yii::$app->getSecurity()->validatePassword($this->password, $user->pass)){
                $this->addError($attribute, 'Логин или пароль введены не верно');
            }
        }


    }

    public function getUser()
    {
        return Users::findOne(['login' => $this->login]);
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'запомнить меня',
        ];
    }

}
