<?php

namespace app\modules\brackets;

class BracketsAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@app/modules/brackets/assets';
    public $js = [
        'js/brackets.js',
    ];
    public $css = [
        'css/brackets.css',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];

}
