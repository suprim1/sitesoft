<?php

namespace app\modules\comment\controllers;

use Yii;
use yii\web\Controller;
use app\modules\comment\models\Comment;

class DefaultController extends Controller {

    public function actionIndex() {

        $model = new Comment();

        $comments = Comment::getComments()->all();
        return $this->render('index', compact('model', 'comments'));
    }

    public function actionAddComment() {
        if (!Yii::$app->user->isGuest && Yii::$app->request->isAjax) {
            $model = new Comment();
            $model->id_user = Yii::$app->user->id;
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save(false);
                $comments = Comment::getComments()->one();
                return $this->renderPartial('addComment', compact('comments'));
            }
        }
    }

    public function actionDeleteComment() {
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $comment = Comment::findOne($post['id']);
            if (Yii::$app->user->id === $comment['id_user']) {
                $comment->delete();
                return $comment['id'];
            }
        }
    }

    public function actionEditComment() {
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $comment = Comment::getComments()->where(['c.id' => $post['id']])->one();
            if (Yii::$app->user->identity->login === $comment['login']) {
                return $this->renderPartial('editComment', compact('comment'));
            }
        }
    }

    public function actionReplaceComment() {
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $comment = Comment::findOne($post['id']);
            if (Yii::$app->user->id === $comment['id_user']) {
                $comm = \yii\helpers\Html::encode($post['comments']);
                $comm = \yii\helpers\HtmlPurifier::process($comm);
                $comment->comments = $comm;
                $comment->save();
                $comments = Comment::getComments()->where(['c.id' => $post['id']])->one();
                return $this->renderPartial('addComment', compact('comments'));
            }
        }
    }

}
