<?php

$config = [
    'id' => 'm22cms-admin',
    'name'=>'m22cms',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'thumbnail'],
    'defaultRoute' => 'admin/dashboard/index',


    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'content' => [
            'class' => 'app\modules\content\Module',
        ],
        'upload' => [
            'class' => 'app\modules\upload\Module',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins'=>['admin','griga'],
            'controllerMap' => [
                'admin' => [
                    'layout'=>'@app/modules/admin/views/layouts/one-column',
                    'class'=>'dektrium\user\controllers\AdminController'
                ],
                'security'=>[
                    'layout'=>'@app/modules/admin/views/layouts/bootstrap',
                    'class'=>'dektrium\user\controllers\SecurityController'
                ],
                'registration'=>[
                    'layout'=>'@app/modules/admin/views/layouts/bootstrap',
                    'class'=>'dektrium\user\controllers\RegistrationController'
                ],
            ],
        ],
        'translation' =>[
            'class' => 'app\modules\translation\Module',
            'layout'=>'@app/modules/admin/views/layouts/one-column',
            'baseUrl' => '/admin/translation/module',
            'languages' => [
                'en' => 'English',
                'ru' => 'Русский',
                'uk' => 'Українська',
            ],
            'sourceLanguage' => 'en',
            'mapping'=>[
                'site'=>'@app/modules/main/messages',
                'core'=>'@app/modules/admin/messages',
            ],
            'controllerBehaviors'=>[
                'access' => [
                    'class' => 'yii\filters\AccessControl',
                    'ruleConfig' => [
                        'class' => 'app\components\auth\filters\AdminAccessRule',
                    ],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
            ],
            'angularAssetClass'=>'app\components\assets\bower\AngularAsset',
        ],

    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[

                'admin' => 'admin/dashboard/index',

                'admin/<module>/<controller:[\w-]+>' => '<module>/<controller>/index',
                'admin/<module>/<controller:[\w-]+>/<id:\d+>' => '<module>/<controller>/view',
                'admin/<module>/<controller:[\w-]+>/<action:[\w-]+>/<id>' => '<module>/<controller>/<action>',
                'admin/<module>/<controller:[\w-]+>/<action:[\w-]+>' => '<module>/<controller>/<action>',
            ]
        ],
        'assetManager' => [
            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null,
//                    'js' => ['//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js']
//                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => []
                ],
            ],
        ],
        'errorHandler'=>[
            'errorAction'=>'admin/dashboard/error',
        ],
        'request' => [
            'cookieValidationKey' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' =>  require(__DIR__ . '/components/mailer.php'),
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'thumbnail' => [
            'class' => 'himiklab\thumbnail\EasyThumbnail',
            'cacheAlias' => 'assets/thumbnails',
        ],
        'db' => require(__DIR__ . '/components/db.php'),
        'lang'=>[
            'class' => 'app\components\lang\Lang',
        ],
        'i18n' => require(__DIR__ . '/components/i18n.php'),
    ],
    'params' => require(__DIR__ . '/params.php'),
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
