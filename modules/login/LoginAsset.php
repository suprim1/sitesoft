<?php

namespace app\modules\login;

class LoginAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@app/modules/login/assets';
    public $js = [
        'js/login.js',
    ];
    public $css = [
        'css/login.css',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];

}
