<?php

use yii\bootstrap\BaseHtml;

app\modules\xmlread\XmlreadAsset::register($this);
$this->title = 'Сообщения';
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h2>Справочник ОКПД2 38798 строк</h2>
    <?=
    BaseHtml::textInput('search', null, [
        'placeholder' => 'Поиск',
        'class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12, js-search',
    ])
    ?>
    <br><br>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 js-search-replace">
        <?= \app\modules\xmlread\widgets\xmlread\XmlreadWidget::widget(['okpd' => $okpd]) ?>
    </div>
</div>
