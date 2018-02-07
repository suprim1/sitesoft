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
        'api' => [
            'class' => 'app\modules\api\CitiesModule',
        ],
        'rest' => [
            'class' => 'app\modules\rest\RestModule',
        ],
    ],
    'components' => [
        'request' => [
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
            'enableStrictParsing' => false,
            'rules' => [
                '/' => 'comment/default/index',
                'logout' => 'login/default/logout',
                'PUT cities/<id>' => 'api/cities/update',
                'DELETE cities/<id>' => 'api/cities/delete',
                'GET cities/<id>' => 'api/cities/view',
                'POST cities' => 'api/cities/create',
                'GET cities' => 'api/cities/index',
                'GET country' => 'api/country/index',
                'GET region' => 'api/region/index',
            ],
        ],
        'sentry' => [
            'class' => 'mito\sentry\Component',
            'dsn' => 'https://7a42076f97a84ff78efeb2e06cf15c7b:f4349579e15041f7bb68b0c20bd22b1c@sentry.io/247983', // private DSN
            'enabled' => YII_ENV_DEV ? false : true,
        //'enabled' => true,
        //'environment' => 'staging', // if not set, the default is `production`
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'mito\sentry\Target',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:404',
                    ],
                ],
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
