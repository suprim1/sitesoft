<?php

namespace app\modules\api\models;

use yii\db\Query;

class Cities extends \yii\db\ActiveRecord {

    public function rules() {
        return [
            [['name'], 'required', 'message' => 'Сообщение не может быть пустым'],
            ['name', 'string'],
            [['name'], 'trim'],
            [['id_country', 'id_region', 'id'], 'integer', 'min' => 1],
        ];
    }

    public static function getCities(int $id = null) {
        $query = (new Query)
                ->select([
                    'c.id',
                    'c.name as name',
                    'co.name as country',
                    'r.name as region',
                ])
                ->from(['c' => 'cities'])
                ->leftJoin('country co', 'c.id_country = co.id')
                ->leftJoin('region r', 'c.id_region = r.id')
                ->orderBy('c.id DESC');
        if ($id) {
            $query = $query->where(['c.id' => $id]);
        }

        return $query;
    }

}
