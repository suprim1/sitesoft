<?php

namespace app\modules\rbac\controllers;

use Yii;
use yii\web\Controller;
use app\rbac\AuthorRule;

class DefaultController extends Controller
{

    /**
     * Заводим роли
     */
    public function actionIndex()
    {
        $admin = Yii::$app->authManager->createRole('admin');
        $admin->description = 'Администратор';
        Yii::$app->authManager->add($admin);

        $user = Yii::$app->authManager->createRole('author');
        $user->description = 'Автор';
        Yii::$app->authManager->add($user);

        var_dump('Роли созданы!');

        $auth = Yii::$app->authManager;
        $rule = new AuthorRule;
        $auth->add($rule);

        var_dump('Rules созданы!');

        $rule = new AuthorRule;
        $permit = Yii::$app->authManager->createPermission('createPost');
        $permit->description = 'Право на создании поста';
        $permit->ruleName = $rule->name;
        Yii::$app->authManager->add($permit);

        $permit = Yii::$app->authManager->createPermission('editPost');
        $permit->description = 'Право на редактирование поста';
        $permit->ruleName = $rule->name;
        Yii::$app->authManager->add($permit);

        $permit = Yii::$app->authManager->createPermission('deletePost');
        $permit->description = 'Право на удаление поста';
        $permit->ruleName = $rule->name;
        Yii::$app->authManager->add($permit);

        var_dump(' Правила созданы!');

        $auth = Yii::$app->authManager;
        $role = Yii::$app->authManager->getRole('author');
        $create = Yii::$app->authManager->getPermission('createPost');
        $edit = Yii::$app->authManager->getPermission('editPost');
        $delete = Yii::$app->authManager->getPermission('deletePost');
        $auth->addChild($role, $create);
        $auth->addChild($role, $edit);
        $auth->addChild($role, $delete);

        var_dump(' Наследование выполнено!');
    }
}