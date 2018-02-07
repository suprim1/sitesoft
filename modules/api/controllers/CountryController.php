<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use yii\filters\AccessControl;

class CountryController extends ActiveController {

    public $modelClass = 'app\modules\api\models\Country';

    public function actions() {
        $actions = parent::actions();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $actions;
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

}

?>
