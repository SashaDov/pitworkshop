<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],//, 'userCounter'],
    'language' => 'en',
    'sourceLanguage' => 'en',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'iVfkQlzpdT988hBiY-vZ7vBzVV_XgynF',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'auth/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
            'class' => \codemix\localeurls\UrlManager::class,
            'languages' => ['en', 'ru', 'de', 'fr'],
            'enableDefaultLanguageUrlCode' => true,
            //'enableLanguageDetection' => false,//нужно вкл автодетекцию, но при этом прописать то что ловит браузер
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'goods/test/<page:\d+>' => 'goods/test',
                //'goods/index/<page:\d+>' => 'goods/index',
                //'goods' => 'goods/index',
                '<controller>/<action>/<page:\d+>' => '<controller>/<action>',
                '<controller>' => '<controller>/index',
                '/' => 'auth/index',
                '<language:(ru-*|ru)>' => '<language:(ru)>',
                '<language:(en-*|en)>' => '<language:(en)>',
                '<language:(de-*|de)>' => '<language:(de)>',
                '<language:(fr-*|fr)>' => '<language:(fr)>',
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'fileMap' => [
                        'app' => 'app.php',
//                        'app/error' => 'error.php',
//                        'app/attributes/user' => 'attributes/user.php',
                    ],
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
        'userCounter' => [
            'class' => 'app\components\UserCounter',
            'tableUsers' => 'pcounter_users',
            'tableSave' => 'pcounter_save',
            'autoInstallTables' => false,
            'onlineTime' => 10, // min
        ],
    ],
    'defaultRoute' => 'auth',
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
