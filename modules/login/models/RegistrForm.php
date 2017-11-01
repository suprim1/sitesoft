<?php

namespace app\modules\login\models;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegistrForm extends \yii\db\ActiveRecord {

    public $login;
    public $password;
    public $termsOfUse = false;
    public $tablePrefix = '';

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['login', 'password', 'termsOfUse'], 'required'],
            ['login', 'string', 'length' => [3, 24]],
            ['login', 'unique'],
            ['termsOfUse', 'boolean', 'falseValue' => false, 'strict' => true, 'message' => 'необходимо согласиться'],
            [['password'], 'string', 'length' => [1, 50]],
        ];
    }

    public static function tableName() {
        return '{{users}}';
    }

    public function getUser() {
        return Users::findOne(['login' => $this->login]);
    }

    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'termsOfUse' => 'Согласен с правилами',
        ];
    }

}
