<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'layoutPath'=>'@backend/themes/adminlte/layouts',
    'components' => [
        [
    'class' => 'yii\i18n\PhpMessageSource',
    'basePath' => '@kvgrid/messages',
    'forceTranslation' => true
],
        'assetManager' => [
        'bundles' => [
            'dmstr\web\AdminLteAsset' => [
                'skin' => 'skin-green',
            ],
        ],
    ],
        'view' => [
         'theme' => [
             'pathMap' => [
                   'pathMap' => ['@backend/views' => '@backend/themes/adminlte'],
                'baseUrl' => '@backend/themes/adminlte',
             ],
         ],
    ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
//         'urlManagerFrontend' => [
//                'class' => 'yii\web\urlManager',
//                'baseUrl' => '@frontend/web/img/',//i.e. $_SERVER['DOCUMENT_ROOT'] .'/yiiapp/web/'
//                'enablePrettyUrl' => true,
//                'showScriptName' => false,
//        ],
    ],
    'params' => $params,
     'modules' => [
   'gridview' =>  [
        'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
    ]
]
];
