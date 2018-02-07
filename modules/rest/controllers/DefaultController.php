<?php

namespace app\modules\rest\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller {

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

    public function actionIndex() {

        return $this->render('index');
    }

}

?>
