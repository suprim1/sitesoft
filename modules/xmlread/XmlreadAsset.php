<?php

namespace app\modules\xmlread;

class XmlreadAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@app/modules/xmlread/assets';
    public $js = [
        'js/xmlread.js',
    ];
    public $css = [
        'css/xmlread.css',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];

}
