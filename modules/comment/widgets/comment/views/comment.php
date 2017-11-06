<div class="well col-lg-12 col-md-12 col-sm-12 col-xs-12 data-id" data-id="<?= $comment['id'] ?>">
    <span><?= $comment['date'] ?></span><br>
    <b><?= $comment['login'] ?></b><br>
    <div class="coment-text js-edit">
        <?= $comment['comments'] ?>
    </div>
    <?php if (Yii::$app->user->can('deletePost', ['id' => $comment['id_user']])): ?>
        <span class="typo-link js-delete-comment">Удалить</span>
    <?php endif ?>
    <?php if (Yii::$app->user->can('editPost', ['id' => $comment['id_user']])): ?>
        / <span class="typo-link js-edit-comment"> Редактировать </span>
    <?php endif ?>
</div>