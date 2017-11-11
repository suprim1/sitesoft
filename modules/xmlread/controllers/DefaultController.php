<?php

namespace app\modules\xmlread\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['author'],
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
