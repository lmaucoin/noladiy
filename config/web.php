<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'G_dJAntSqp0CJwaa87GseKgrtL7BWWOz',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
              'events/?' => 'event/index',
              'venues/?' => 'venue/index',
              'event/<id:\d+>' => 'event/view',
              'venue/<id:\d+>' => 'venue/view',
            ],
        ],
        'authManager' => [
          'class' => 'yii\rbac\DbManager'
        ],
        'view' => [
          'class' => 'yii\web\View',
          'renderers' => [
            'twig' => [
              'class' => 'yii\twig\ViewRenderer',
              'cachePath' => '@runtime/Twig/cache',
              'options' => [
                'auto_reload' => true,
              ],
              'globals' => [
                'html' => ['class' => '\yii\helpers\Html'],
              ],
              'uses' => ['yii\bootstrap','Twig\Extra\Intl\IntlExtension'],
              'extensions' => [
                \yii\twig\html\HtmlHelperExtension::class,
                \Twig\Extra\Intl\IntlExtension::class
              ],
            ],
          ]
        ]
    ],
    'params' => $params,
];

if(getenv('YII_ENV') == "dev") {
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
        'allowedIPs' => ['*'],
    ];
}

return $config;
