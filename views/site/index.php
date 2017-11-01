<?php

$this->title = 'Perekup Avto';
?>
<div class="container">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        Тут будет описание Perekup Avto
        <?= var_dump(Yii::$app->getSecurity()->generatePasswordHash('password')) ?>
        <?= !Yii::$app->user->isGuest ? 'Добро пожаловать ' : ''?>
    </div>
</div>
