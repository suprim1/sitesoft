<?php

namespace app\modules\brackets\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\brackets\models\Brackets;
use Yii;

class DefaultController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'check-brackets'],
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

    public function actionCheckBrackets() {
        $model = new Brackets;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return Brackets::check($model->brackets);
        }
    }

}

?>
