<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'micro-app',
    'basePath' => dirname(__DIR__),
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\v1',
        ],
    ],
    'controllerNamespace' => 'app\controllers',
    'aliases' => [
        '@app' => __DIR__ . '/../',
    ],
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'GET v1/<controller:\w+>/<id:\d+>' => 'v1/<controller>/view',
                'GET v1/<controller:\w+>' => 'v1/<controller>/index',
                'POST v1/<controller:\w+>' => 'v1/<controller>/create',
                'PUT,PATCH v1/<controller:\w+>/<id:\d+>' => 'v1/<controller>/update',
                'DELETE v1/<controller:\w+>/<id:\d+>' => 'v1/<controller>/delete',

                '<alias:\w+>' => 'site/<alias>',
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfCookie' => false,
        ],
        'db' => $db,
    ],
    'params' => $params,
];
