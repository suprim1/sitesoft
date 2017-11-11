<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'sourceLanguage' => 'ru',
    'modules' => [
        'comment' => [
            'class' => 'app\modules\comment\CommentModule',
        ],
        'login' => [
            'class' => 'app\modules\login\LoginModule',
        ],
        'rbac' => [
            'class' => 'app\modules\rbac\RbacModule',
        ],
        'xmlread' => [
            'class' => 'app\modules\xmlread\XmlreadModule',
        ],
        'brackets' => [
            'class' => 'app\modules\brackets\BracketsModule',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sSDsddsdSD4_sdCVmKlLfser2#',
            'baseUrl' => '',
        ],
        'errorHandler' => [
            'errorAction' => 'comment/default/error',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\login\models\Users',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],

        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'comment/default/index',
                'logout' => 'login/default/logout',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1'],
    ];
}

return $config;
