<?php

namespace app\modules\xmlread\models;

use yii\db\Query;

class Xmlread extends \yii\db\ActiveRecord {

    public static function tableName() {
        return '{{OKPD}}';
    }

    /**
     *
     * @return array
     */
    public static function All() {
        return (new Query)
                        ->select('Name, Kod')
                        ->from('OKPD')
                        ->orderBy('kod')
                        ->where(['SubKod2' => NULL])
                        ->all();
    }

    /**
     * Получаем массив данных в зависимости от вложенности
     * @param string $kod
     * @return array/null
     */
    public static function findKod(string $kod) {
        $subkods = explode('.', $kod);
        $count = count($subkods);

        if ($count < 4) {
            $query = (new Query)
                    ->select('Name, Kod')
                    ->from('OKPD');
            if ($count < 3) {
                $query->andWhere([
                    'SubKod' . ($count + 2) => null,
                ]);
            }
            $query->andWhere(['>', 'SubKod' . ($count + 1), 0,]);
            foreach ($subkods as $key => $subkod) {
                if ($key < 3) {
                    $query->andWhere([
                        'SubKod' . ($key + 1) => (int) $subkod
                    ]);
                }
            }
            $result = $query->all();
        } else {
            $result = null;
        }
        return $result;
    }

    public static function searchAll(string $search) {
        $query = (new Query)
                ->select('Name, Kod')
                ->from('OKPD')
                ->where(['like', 'Name', ['search' => trim($search)]])
                ->limit(20)
                ->all();
        $result = [];
        foreach ($query as $key => $okpd) {
            $subkods = explode('.', $okpd['Kod']);
            $count = count($subkods);
            for ($i = 1; $i < $count; $i++) {
                $queryNew = (new Query)
                        ->select('Name, Kod')
                        ->from('OKPD');
                for ($j = 1; $j <= $i; $j++) {
                    $queryNew->andWhere([
                        'SubKod' . $j => $subkods[$j - 1],
                    ]);
                }
                $queryNew->andWhere([
                    'SubKod' . ($i + 1) => null,
                ]);
                $line = $queryNew->one();
                switch ($i) {
                    case 1:
                        if (!isset($result[$line['Kod']])) {
                            $result[$line['Kod']] = $line;
                        }
                        break;
                    case 2:
                        if (!isset($result[$subkods[0]]['sub'][$subkods[1]])) {
                            $result[$subkods[0]]['sub'][$subkods[1]] = $line;
                        }
                        break;
                    case 3:
                        if (!isset($result[$subkods[0]]['sub'][$subkods[1]]['sub'][$subkods[2]])) {
                            $result[$subkods[0]]['sub'][$subkods[1]]['sub'][$subkods[2]] = $line;
                        }
                        break;
                }
            }
            switch ($count) {
                case 1:
                    if (!isset($result[$okpd['Kod']])) {
                        $result[$okpd['Kod']] = $okpd;
                    }
                    break;
                case 2:
                    if (!isset($result[$subkods[0]]['sub'][$subkods[1]])) {
                        $result[$subkods[0]]['sub'][$subkods[1]] = $okpd;
                    }
                    break;
                case 3:
                    if (!isset($result[$subkods[0]]['sub'][$subkods[1]]['sub'][$subkods[2]])) {
                        $result[$subkods[0]]['sub'][$subkods[1]]['sub'][$subkods[2]] = $okpd;
                    }
                    break;
                case 4:
                    if (!isset($result[$subkods[0]]['sub'][$subkods[1]]['sub'][$subkods[2]]['sub'][$subkods[3]])) {
                        $result[$subkods[0]]['sub'][$subkods[1]]['sub'][$subkods[2]]['sub'][$subkods[3]] = $okpd;
                    }
                    break;
            }
        }
        return $result;
    }

}
