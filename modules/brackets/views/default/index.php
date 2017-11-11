<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

app\modules\brackets\BracketsAsset::register($this);
$this->title = 'Проверка на скобки';
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php
    $form = ActiveForm::begin([
                'id' => 'add-comment',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 error_height js-brackets-result\">{error}</div><div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">{input}</div>",
                    'labelOptions' => ['class' => 'control-label'],
                ],
    ]);
    ?>
    <?=
    $form->field($model, 'brackets')->textarea([
        'autofocus' => true,
        'class' => 'js-brackets-text col-lg-12 col-md-12 col-sm-12 col-xs-12',
        'placeholder' => $model->getAttributeLabel('brackets'),
        'rows' => 4,
    ])
    ?>
    <div class="form-group text-right col-lg-1 col-lg-offset-7 col-md-2 col-sm-2 col-sx-5">
        <?= Html::button('Правильно!', ['class' => 'btn btn-success js-check-brackets', 'name' => 'check-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
