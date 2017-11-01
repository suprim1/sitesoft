<div class="well col-lg-12 col-md-12 col-sm-12 col-xs-12 data-id" data-id="<?= $comments['id'] ?>">
    <span><?= $comments['date'] ?></span><br>
    <b><?= $comments['login'] ?></b><br>
    <div class="coment-text js-edit">
        <?= $comments['comments'] ?>
    </div>
    <?php if ($comments['login'] === Yii::$app->user->identity->login): ?>
        <span class="typo-link js-delete-comment">Удалить</span> / <span class="typo-link js-edit-comment"> Редактировать </span>
    <?php endif ?>
</div>