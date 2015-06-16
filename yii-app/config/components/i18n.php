<?php 
return [
        'translations' => [
            'core*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/modules/admin/messages',
                'sourceLanguage' => 'en',
                'fileMap' => [
                    'core' => 'core.php',
                ],
            ],
            'site*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/modules/main/messages',
                'sourceLanguage' => 'en',
                'fileMap' => [
                    'site' => 'site.php',
                ],
            ],
        ],
    ];