<?php
app\modules\rest\RestAsset::register($this);
$this->title = 'REST';
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="js-load col-lg-4 col-md-6 col-sm-8 col-xs-12">
        <div class='js-index rest-border'>
            <label>Добавить город:</label><br>
            <input type="text" name="name" class="js-cities-created-input"><br>
            <label>Выберите страну:</label><br>
            <select type="" name="id_country" class="js-country-select"></select><br>
            <label>Выберите регион:</label><br>
            <select type="text" name="is_region" class="js-region-select"></select><br>
            <button class="js-cities-created">Добавить город</button>
        </div>
    </div>
</div>