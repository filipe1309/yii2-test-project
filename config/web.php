<?php

$params = require(__DIR__ . '/params.php');
use \yii\web\Request;
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        /*'authManager' => [
            'class' => 'yii\rbac\MongoDbManager',
            'defaultRoles' => ['guest'],
        ],*/
        /*'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://developer:password@localhost:27017/mydatabase',
        ],*/
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'X0bFpGcgzcC5woOGgoe_Zq4F-OUrjsVW',
            'baseUrl' => $baseUrl,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',
            //'enableAutoLogin' => true,
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',

            // Comment this if you don't want to record user logins
            'on afterLogin' => function($event) {
                    \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
                }
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [ //sendGrid
            'class' => 'bryglen\sendgrid\Mailer',
            'username' => '--',
            'password' => '--',
            //'viewPath' => '@app/views/mail', // your view path here
        ],
        //'mailer' => [
            //-'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //-'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            /*'transport' => [
                'class' => 'Swift_MailTransport',
            ],*/
            //https://www.google.com/settings/security/lesssecureapps
            //https://accounts.google.com/b/0/DisplayUnlockCaptcha
            // a porta do smtp esta bloqueada no c9 =/
            /*'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => '---@gmail.com',
                'password' => '---',
                'port' => '587', //25
                'encryption' => 'tls',
            ],*/
            /*'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailtrap.io',//mailtrap.io
                'username' => 'bd155f2c33a0d2',
                'password' => '8c32877faaa2ac',
                'port' => '25', //587
                'encryption' => 'tls',
                 'timeout' => 300,
            ],*/
        //],
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
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Hide index.php
            'showScriptName' => false,
            // Use pretty URLs
            'enablePrettyUrl' => true,
            'rules' => [
                '<alias:\w+>' => 'site/<alias>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
            ],
        ],
        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],*/
        /*'urlManager' => [
            'enablePrettyUrl' => true,
            //'enableStrictParsing' => true,
            'showScriptName' => false,

            'rules'=>[
                //['class' => 'yii\rest\UrlRule', 'controller' => 'instituicoes'],
                [
                    'pattern' => 'gridview/export/download',
                    'route' => 'gridview/export/download',
                ],
                '' => 'site/index', // para retirar o "site" do endereço
                '<action>'=>'site/<action>', // para retirar o "site" do endereço
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\w+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                //'setores/<action:(view|index|create|update|delete)>' => 'setores2/<action>', // para redirecionar para o controller setores e não o módulo do obsrepo

                'api/<module:\w+>/<controller:\w+>/<id:\d+>' => 'api/<module>/<controller>/view',
                'api/<module:\w+>/<controller:\w+>/<action:\w+>' => 'api/<module>/<controller>/<action>',
                'api/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => 'api/<module>/<controller>/<action>',

                // Modulos - Endereço padrao "/módulo/controller/action/id"
                    '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                    '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\w+?.*>' => '<module>/<controller>/<action>',
            ],
        ],*/
    ],
    'modules'=>[
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
    
            // 'enableRegistration' => true,
    
            // Add regexp validation to passwords. Default pattern does not restrict user and can enter any set of characters.
            // The example below allows user to enter :
            // any set of characters
            // (?=\S{8,}): of at least length 8
            // (?=\S*[a-z]): containing at least one lowercase letter
            // (?=\S*[A-Z]): and at least one uppercase letter
            // (?=\S*[\d]): and at least one number
            // $: anchored to the end of the string
    
            //'passwordRegexp' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',
    
    
            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            'on beforeAction'=>function(yii\base\ActionEvent $event) {
                    if ( $event->action->uniqueId == 'user-management/auth/login' )
                    {
                        $event->action->controller->layout = 'loginLayout.php';
                    };
                },
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1','::1', $_SERVER['REMOTE_ADDR'] ],
        /*'generators' => [
                'mongoDbModel' => [
                    'class' => 'yii\mongodb\gii\model\Generator'
                ],
                'n-model'     => 'webvimark\generators\model\Generator',
                'n-crud'      => 'webvimark\generators\crud\Generator',
                'n-module'    => 'webvimark\generators\module\Generator',
                'n-extension' => 'webvimark\generators\extension\Generator',
        ],*/
    ];
}

return $config;
