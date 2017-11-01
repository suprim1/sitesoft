<?php

namespace app\modules\comment;

class CommentAsset extends \yii\web\AssetBundle
{

    public $sourcePath = '@app/modules/comment/assets';
    public $js = [
        'js/comment.js',
    ];
    public $css = [
        'css/comment.css',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];

}
