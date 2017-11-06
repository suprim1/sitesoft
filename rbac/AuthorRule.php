<?php

namespace app\rbac;

use yii\rbac\Rule;
use Yii;

class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    public function execute($user_id, $item, $params)
    {
        return isset($params['id']) ? ($params['id'] == $user_id || Yii::$app->user->can('admin')) : false;
    }
}