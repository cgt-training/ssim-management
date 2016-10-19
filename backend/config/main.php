<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => [ 'site/login' ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'request'=>[
            'class' => 'common\components\Request',
            'web'=> '/backend/web',
            'adminUrl' => '/admin'
        ],
        'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [                
                'company/view/<id:\d+>' => 'company/view',
                'company/viewcompany/<id:\d+>' => 'company/viewcompany',
                'company/update/<id:\d+>' => 'company/update',
                'branch/view/<id:\d+>' => 'branch/view',
                'branch/update/<id:\d+>' => 'branch/update',
                'department/view/<id:\d+>' => 'department/view',
                'department/update/<id:\d+>' => 'department/update',
                'user/view/<id:\d+>' => 'user/view',
                'user/update/<id:\d+>' => 'user/update',
                ],
                
        ],
        'urlManagerFrontend' => [
                'class' => 'yii\web\urlManager',
                'baseUrl' => '/ssim-management/frontend/web/',//i.e. $_SERVER['DOCUMENT_ROOT'] .'/yiiapp/web/'
                'enablePrettyUrl' => true,
                'showScriptName' => false,
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
