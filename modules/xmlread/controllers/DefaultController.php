<?php

namespace app\modules\xmlread\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\xmlread\models\Xmlread;

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
                    [
                        'actions' => ['find-kod', 'search'],
                        'allow' => true,
                        'roles' => ['author'],
                        'verbs' => ['get'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex() {
        $okpd = Xmlread::All();
        return $this->render('index', compact('okpd'));
    }

    public function actionFindKod(string $kod) {
        $okpd = Xmlread::findKod($kod);
        return $okpd == null ? '' : $this->renderPartial('okpd', compact('okpd'));
    }

    public function actionSearch(string $search) {
        if (empty($search)) {
            $okpd = Xmlread::All();
        } else {
            $okpd = Xmlread::searchAll($search);
        }
        return $this->renderPartial('search', compact('okpd', 'search'));
    }

}

?>
