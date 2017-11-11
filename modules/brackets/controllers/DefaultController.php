<?php

namespace app\modules\brackets\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\brackets\models\Brackets;

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

        $model = new Brackets;
        return $this->render('index', compact('model'));
    }

}

?>
