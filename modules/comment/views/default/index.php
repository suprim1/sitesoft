<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

app\modules\comment\CommentAsset::register($this);
$this->title = 'Сообщения';
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if (!Yii::$app->user->isGuest): ?>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'add-comment',
                    'layout' => 'horizontal',
                    'validateOnBlur' => false,
                    'validateOnType' => false,
                    'validateOnChange' => false,
                    'validateOnSubmit' => true,
                    'fieldConfig' => [
                        'template' => "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 error_height\">{error}</div><div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">{input}</div>",
                        'labelOptions' => ['class' => 'control-label'],
                    ],
        ]);
        ?>
        <div class="alert alert-error js-error-comment">
            Сообщение не может быть пустым
        </div>
        <?=
        $form->field($model, 'comments')->textarea([
            'autofocus' => true,
            'class' => 'js-comment-text col-lg-12 col-md-12 col-sm-12 col-xs-12',
            'placeholder' => $model->getAttributeLabel('comments'),
            'rows' => 4,
        ])
        ?>

        <div class="form-group text-right col-lg-1 col-lg-offset-7 col-md-2 col-sm-2 col-sx-5">
            <?= Html::button('Отправить сообщение', ['class' => 'btn btn-primary js-add-comment', 'name' => 'add-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?php foreach ($comments as $comment): ?>
            <div class="well col-lg-12 col-md-12 col-sm-12 col-xs-12 data-id" data-id="<?= $comment['id'] ?>">
                <span><?= $comment['date'] ?></span><br>
                <b><?= $comment['login'] ?></b><br>
                <div class="coment-text js-edit">
                    <?= $comment['comments'] ?>
                </div>
                <?php if ($comment['login'] === Yii::$app->user->identity->login): ?>
                    <span class="typo-link js-delete-comment">Удалить</span> / <span class="typo-link js-edit-comment"> Редактировать </span>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    <?php else: ?>
    Авторизуйтесь!!!
    <?php endif ?>
</div>
