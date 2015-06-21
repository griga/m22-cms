<?php

if (getenv('OPENSHIFT_MYSQL_DB_HOST')) {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=' . getenv('OPENSHIFT_MYSQL_DB_HOST') . ':' . getenv('OPENSHIFT_MYSQL_DB_PORT') . ';dbname=',
        'username' => getenv('OPENSHIFT_MYSQL_DB_USERNAME'),
        'password' => getenv('OPENSHIFT_MYSQL_DB_PASSWORD'),
        'charset' => 'utf8',
        'tablePrefix' => ''
    ];
} else {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'tablePrefix' => ''
    ];
}



