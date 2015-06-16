<?php

return [
    'adminEmail' => 'm22admin@gmail.com',
    'systemEmail' => 'm22system@gmail.com',
    'systemName' => 'Service Test',

    'languagesConfig'=>[
        'ru'=>[
            'key'=>'ru',
            'language'=>'Русский',
            'description'=>'ru meta site description',
            'keywords'=>'ru meta site keywords',
            'title'=>'m22cms',
            'suffix'=>' - m22cms',
        ],
        'uk'=>[
            'key'=>'uk',
            'language'=>'Українська',
            'description'=>'uk meta site description',
            'keywords'=>'uk meta site keywords',
            'title'=>'m22cms',
            'suffix'=>' - m22cms',
        ],
        'en'=>[
            'key'=>'en',
            'language'=>'English',
            'description'=>'en meta site description',
            'keywords'=>'en meta site keywords',
            'title'=>'m22cms',
            'suffix'=>' - m22cms',
        ],
    ],
    
    'defaultLanguage' => 'en',
    'sourceLanguage' => 'en',
    'emailsInMinute' => 1,
    'emailSleep' => 10,
    'apiKeys'=>[
        'recaptcha'=>[
            'private'=>''
        ],
    ],
];
