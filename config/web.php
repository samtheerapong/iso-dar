<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'EN-APP',
    'language' => 'th',
    'timezone' => 'Asia/Bangkok',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        [
            'class' => 'app\components\LanguageSelector',
            'supportedLanguages' => ['en-US', 'th-TH'], //กำหนดรายการภาษาที่ support หรือใช้ได้
        ]
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'dar' => [
            'class' => 'app\modules\dar\Module',
        ],
        'nfc' => [
            'class' => 'app\modules\nfc\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // 'i18n' => []
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/adminlte/'
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity',
                'httpOnly' => true,
            ],
            'loginUrl' => ['site/login'], // Set the login page route
        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '6_cOWNpfGKTh_E_iz6F0fWPBEo1AbRTa',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    // 'sourceLanguage' => 'en-US',
                ],
            ],
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
        'db' => $db,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'location', 'except' => ['delete', 'GET', 'HEAD', 'POST', 'OPTIONS'], 'pluralize' => false],
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
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
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
