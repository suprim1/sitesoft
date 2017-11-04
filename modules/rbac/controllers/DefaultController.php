<?php

namespace app\modules\rbac\controllers;

use Yii;
use yii\web\Controller;

class DefaultController extends Controller {

    public function actionIndex() {
        $admin = Yii::$app->authManager->createRole('admin');
        $admin->description = 'Администратор';
        Yii::$app->authManager->add($admin);

        $user = Yii::$app->authManager->createRole('author');
        $user->description = 'Автор';
        Yii::$app->authManager->add($user);

        var_dump('Роли созданы!');
    }

}
