<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => '/video/index',
    'controllerNamespace' => 'frontend\controllers',
    'name' => 'Youtube',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => yii\web\UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'debug/<controller>/<action>' => 'debug/<controller>/<action>',
                '' => 'video/index',
                'video/<video_id>' => 'video/view',
                'video/like/<video_id>' => '/video/like',
                'video/dislike/<video_id>' => '/video/dislike',
                'result' => '/video/search',
                'history' => '/video/history',
                'channel/<username>' => '/channel/view',
                'channel/subscribe/<username>' => '/channel/subscribe'
            ],
        ],
    ],
    'params' => $params,
];
