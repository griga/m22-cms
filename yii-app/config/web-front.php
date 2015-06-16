<?php

$config = [
    'id' => 'm22cms-site',
    'name'=>'m22 CMS',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','thumbnail'],
    'defaultRoute' => 'main/site/index',


    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module'
        ],
        'sitemap'=>[
            'class'=> 'app\modules\sitemap\Module',
            'models'=>[
                'app\modules\content\models\Page',
            ],
        ],
    ],
    'components' => [
        'urlManager' => [
            'class'=>'app\components\lang\LangUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'exclude'=>[
                'sitemap', 'gii'
            ],
            'rules'=>[
                '' => 'main/site/index',
                '<lang:(\w{2})>' => 'main/site/index',
                '<lang:(\w{2})>/main/site/index' => 'main/site/index',

                '<lang:(\w{2})>/news'=>'main/site/news',
                '<lang:(\w{2})>/news/<alias:[\d\w-/]+>'=>'main/site/news-item',

                '<lang:(\w{2})>/contact'=>'main/site/contact',
                '<lang:(\w{2})>/main/site/captcha'=>'main/site/captcha',

                '<lang:(\w{2})>/<alias:[\d\w-/]+>'=>'main/site/page',
                

                
                'api/<action:[\d\w-]+>'=>'main/api/<action>',
                ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
            ]
        ],
        'assetManager' => [
            'bundles' => [
               'yii\bootstrap\BootstrapAsset' => [
                   'css' => [],
               ],
            ],
        ],
        'errorHandler'=>[
            'errorAction'=>'main/site/error',
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
        'mailer' =>  require(__DIR__ . '/mailer.php'),
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'thumbnail' => [
            'class' => 'himiklab\thumbnail\EasyThumbnail',
            'cacheAlias' => 'assets/thumbnails',
        ],
        'seoRenderer'=>[
            'class'=>'app\components\seo\SeoRenderer',
        ],
        'lang'=>[
            'class' => 'app\components\lang\Lang',
        ],
        'i18n' =>  require(__DIR__ . '/components/i18n.php'),
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
