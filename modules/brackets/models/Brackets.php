<?php

namespace app\modules\brackets\models;

class Brackets extends \yii\db\ActiveRecord {

    public $brackets;

    public function rules() {
        return [
            [['brackets'], 'required', 'message' => 'Обязательно для заполнения!!!'],
            [['brackets'], 'trim'],
        ];
    }

    public function attributeLabels() {
        return [
            'brackets' => 'Проверка на правильность расстановки скобок {}',
        ];
    }

    public static function check(string $text) {
        $len = strlen($text);
        $bracketsRight = 0;
        $bracketsLeft = 0;
        for ($i = 0; $i < $len; $i++) {
            if ($text[$i] == '{') {
                $bracketsLeft += 1;
            } else if ($text[$i] == '}') {
                $bracketsRight += 1;
                if ($bracketsRight > $bracketsLeft) {
                    return false;
                }
            }
        }
        if ($bracketsRight < $bracketsLeft){
            return false;
        }
        return true;
    }

}
