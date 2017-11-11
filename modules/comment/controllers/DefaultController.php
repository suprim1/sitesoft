<?php

namespace app\modules\comment\controllers;

use Yii;
use yii\web\Controller;
use app\modules\comment\models\Comment;
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
                        'roles' => ['@', '?'],
                    ],
                    [
                        'actions' => ['add-comment', 'edit-comment', 'replace-comment', 'delete-comment'],
                        'allow' => true,
                        'roles' => ['author'],
                        'verbs' => ['post'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex() {

        $model = new Comment();

        $comments = Comment::getComments()->all();
        if (Yii::$app->user->isGuest) {
            return $this->render('description');
        } else {
            return $this->render('index', compact('model', 'comments'));
        }
    }

    public function actionAddComment() {
        $model = new Comment();
        if (Yii::$app->user->can('createPost', ['id' => Yii::$app->user->id])) {
            $model->id_user = Yii::$app->user->id;
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->comments = Comment::xss($model->comments);
                $model->save(false);
                $comments = Comment::getComments()->one();
                return $this->renderPartial('addComment', compact('comments'));
            }
        }
    }

    public function actionDeleteComment() {
        $post = Yii::$app->request->post();
        $comment = Comment::findOne($post['id']);
        if (Yii::$app->user->can('deletePost', ['id' => $comment['id_user']])) {
            $comment->delete();
            return $comment['id'];
        }
    }

    public function actionEditComment() {
        $post = Yii::$app->request->post();
        $comment = Comment::getComments()->where(['c.id' => $post['id']])->one();
        if (Yii::$app->user->can('editPost', ['id' => $comment['id_user']])) {
            return $this->renderPartial('editComment', compact('comment'));
        }
    }

    public function actionReplaceComment() {
        $post = Yii::$app->request->post();
        $comment = Comment::findOne($post['id']);
        if (Yii::$app->user->can('editPost', ['id' => $comment['id_user']])) {
            $comment->comments = Comment::xss($post['comments']);
            $comment->save();
            $comments = Comment::getComments()->where(['c.id' => $post['id']])->one();
            return $this->renderPartial('addComment', compact('comments'));
        }
    }

}

?>
