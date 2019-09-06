<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=46.160.244.158;dbname=ztGLQn3JmFmFMtX5rB469LMb',
            'username' => 'ztGLQn3JmFmFMtX5rB469LMb',
            'password' => 'JR3UvqKkWV8vuxyaCLM6BacJ',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
