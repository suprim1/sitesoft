<?php

namespace app\modules\comment\models;

use yii\db\Query;

class Comment extends \yii\db\ActiveRecord {

    public function rules() {
        return [
            [['comments'], 'required', 'message' => 'Сообщение не может быть пустым'],
            [['comments'], 'trim'],
            [['comments'], 'string', 'min' => 1],
            [['id_user'], 'integer', 'min' => 1],
        ];
    }

    public function xxs($attribute, $params) {
        var_dump($attribute);
        var_dump($params);
        die;
    }

    public function attributeLabels() {
        return [
            'comments' => 'Ваше сообщение...',
        ];
    }

    public static function getComments() {
        $query = new Query();
        return $query->select([
                            'c.id',
                            'c.comments',
                            'u.login',
                            'date(c.date) as date'
                        ])
                        ->from(['c' => 'comment'])
                        ->leftJoin('users u', 'c.id_user = u.id')
                        ->orderBy('c.id DESC');
    }

    public static function findLoginToId(int $id) {
        $query = new Query();
        return $query->select([
                            'id_login'
                        ])
                        ->from('comment')
                        ->where(['id' => $id])
                        ->one();
    }

}
