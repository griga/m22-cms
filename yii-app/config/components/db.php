<?php

if (getenv('OPENSHIFT_MYSQL_DB_HOST')) {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=' . getenv('OPENSHIFT_MYSQL_DB_HOST') . ':' . getenv('OPENSHIFT_MYSQL_DB_PORT') . ';dbname=m22cms',
        'username' => getenv('OPENSHIFT_MYSQL_DB_USERNAME'),
        'password' => getenv('OPENSHIFT_MYSQL_DB_PASSWORD'),
        'charset' => 'utf8',
        'tablePrefix' => 'm22_'
    ];
} else {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=m22cms',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'tablePrefix' => 'm22_'
    ];
}



