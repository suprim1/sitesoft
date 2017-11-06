<?php

namespace app\modules\login\controllers;

use yii\web\Controller;
use Yii;
use app\modules\login\models\LoginForm;
use app\modules\login\models\RegistrForm;
use app\modules\login\models\Users;
use app\modules\comment\models\Comment;

class DefaultController extends Controller {

    public function actionIndex() {
        if (!yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if (yii::$app->request->post('LoginForm')) {

            if ($model->load(yii::$app->request->post()) && $model->validate()) {
                Yii::$app->user->login($model->getUser());
                return $this->goHome();
            }
        }

        return $this->render('index', [
                    'model' => $model,
        ]);
    }

    public function actionRegistr() {
        if (Yii::$app->request->isAjax && Yii::$app->user->isGuest) {
            $model = new RegistrForm();
            return $this->renderAjax('registr', compact('model'));
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        if (!yii::$app->user->isGuest) {
            Yii::$app->user->logout();
            return $this->redirect(['/login']);
        }
    }

    public function actionRegval() {

        $model = new RegistrForm();
        if (Yii::$app->request->isAjax && Yii::$app->user->isGuest && $model->load(yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }
        if ($model->load(yii::$app->request->post()) && $model->validate()) {
            $users = new Users;
            $users->login = Comment::xss($model->login);
            $users->pass = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            if ($users->save(false)) {
                Yii::$app->user->login($model->getUser());
                $userRole = Yii::$app->authManager->getRole('author');
                Yii::$app->authManager->assign($userRole, Yii::$app->user->getId());
                return $this->goHome();
            }
        }
    }

}
