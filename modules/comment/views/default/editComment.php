<div class="well col-lg-12 col-md-12 col-sm-12 col-xs-12 data-id" data-id="<?= $comment['id'] ?>">
    <span><?= $comment['date'] ?></span><br>
    <b><?= $comment['login'] ?></b><br>
    <textarea class="coment-text js-edit col-lg-12 col-md-12 col-sm-12 col-xs-12"><?= $comment['comments'] ?></textarea>
    <?php if ($comment['login'] === Yii::$app->user->identity->login): ?>
        <span class="typo-link js-replace-comment">Ок</span>
    <?php endif ?>
</div>