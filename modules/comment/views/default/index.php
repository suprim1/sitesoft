<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use app\modules\comment\widgets\comment\CommentWidget;

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
            <?= CommentWidget::widget(['comment' => $comment,]) ?>
        <?php endforeach ?>
    <?php else: ?>
        <h2>Просто тестовое задание</h2><br>
        <ul>
            <li>rbac</li>
            <li>AJAX</li>
            <li>Авторизация и Регистрация(Роль администратора: admin/password)</li>
        </ul>


        <h3>Роли:</h3>
        <ul>
            <li>Админ (добавлять/изменять/удалять все сообщения)</li>
            <li>Пользователь (добавлять/изменять/удалять свои сообщения)</li>
        </ul>

        <h3>Немного описания</h3>
        <ul>
            <li>Сортировка - снизу-вверх (последние добавленное сообщение - сверху). У каждого сообщения, помимо текста, указано имя (username) автора и время добавления.</li>
            <li>Если пользователь авторизован, ему становится доступна форма отправки сообщения.</li>
            <li>Сообщение не может быть пустым (или состоять только из пробелов).</li>
            <li>При попытке отправки такого сообщения - пользователю выдается предупреждение “Сообщение не может быть пустым”.</li>
            <li>После успешной отправки, сообщение пользователя сразу появляется на “стене”.</li>
            <li>Добавление, правка и удаление своих сообщений, реализовано на ajax.</li>
        </ul>
    <?php endif ?>
</div>
