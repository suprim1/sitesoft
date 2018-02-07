<?php

namespace app\modules\rest;

class RestAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@app/modules/rest/assets';
    public $js = [
        'js/rest.js',
        'js/jquery-ui.min.js',
    ];
    public $css = [
        'css/rest.css',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];

}
