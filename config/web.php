<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
if (file_exists(__DIR__ . '/db-local.php')) {
    $db = require(__DIR__ . '/db-local.php');
}

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'bootstrap' => ['debug'],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
        ],
        'gridview' =>  [
        'class' => '\kartik\grid\Module',
        'downloadAction' => 'gridview/export/download',
         'i18n' => []
    ],
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',
            // the global settings for the disqus widget
            'disqus' => [
                'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
            ],
            // the global settings for the facebook plugins widget
            'facebook' => [
                'appId' => '373328526349264',
                'secret' => '81562e694b722803c4d3754b4625dfc4',
                'default_graph_version' => 'v2.8',
                'channelUrl' => 'http://localhost/yiiApp/basic/web/index.php?r=couple-partner%2Findex',
                'status'=> 'true',
        'cookie'=> 'true',
        'xfbml'=> 'true'
            ],
//            // the global settings for the google plugins widget
//            'google' => [
//                'clientId' => 'GOOGLE_API_CLIENT_ID',
//                'pageId' => 'GOOGLE_PLUS_PAGE_ID',
//                'profileId' => 'GOOGLE_PLUS_PROFILE_ID',
//            ],
//            // the global settings for the google analytic plugin widget
//            'googleAnalytics' => [
//                'id' => 'TRACKING_ID',
//                'domain' => 'TRACKING_DOMAIN',
//            ],
            // the global settings for the twitter plugins widget
//            'twitter' => [
//                'screenName' => 'TWITTER_SCREEN_NAME'
//            ],
        ],
    // ...
    ],
    'language' => 'en',
    'sourceLanguage' => 'en',
    'components' => [
        
        'sphinx' => [
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=localhost;dbname=fortesting',
            'username' => 'root',
            'password' => 'password',
        ],
        'assetManager' => [
        'linkAssets' => true,
    ], 
        'reCaptcha' => [
        'name' => 'reCaptcha',
        'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
        'siteKey' => '6LcySRMUAAAAAKTOeMZ3XmnflPoRbR6YXgCLGKYU',
        'secret' => '6LcySRMUAAAAAB_EsBmj8lmQhZdZ1hs8knZq4mRy',
    ],
        'assetManager' => [
        'bundles' => [
            'dosamigos\google\maps\MapAsset' => [
                'options' => [
                    'key' => 'AIzaSyClSFF9Er2FLd9EcIYO4UxET-v64-L247c',
                    'language' => 'id',
                    'version' => '3.1.18'
                ]
            ],
        
            'yii\web\JqueryAsset' => [
                            'js' => [
                                 'jquery.min.js'
                            ]
                        ],
                        'yii\bootstrap\BootstrapAsset' => [
                            'css' => [
                                'css/bootstrap.min.css',
                            ]
                        ],
                        'yii\bootstrap\BootstrapPluginAsset' => [
                            'js' => [
                                 'js/bootstrap.min.js',
                            ]
                        ]
            ]
    ],
        
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'geolocation' => [
            'class' => 'rodzadra\geolocation\Geolocation',
            'config' => [
                'provider' => 'ippycox',
                'format' => 'xml',
                'api_key' => 'AIzaSyDWuLvFM5bizzeBwGnQaY6Bk8TGedNTATc',
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceLanguage' => 'en',
//                    'fileMap' => [
//                        'app' => 'app.php',
//                        'app/error' => 'error.php',
//                    ],
                    'on missingTranslation' => ['app\components\TranslationEventHandler', 'handleMissingTranslation']
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'korolo123',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '373328526349264',
                    'clientSecret' => '81562e694b722803c4d3754b4625dfc4',
                    'attributeNames' => ['name', 'email', 'first_name', 'last_name','user_friends'],
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\CouplePartner',
            'loginUrl' => ['site/login-after-error'], 
            'returnUrl'=>['wedding-estimated-budget/index'],
            'enableAutoLogin' => true,
            'enableSession' => true,
        ],
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                                'class' => 'Swift_SmtpTransport',
                                'host' => 'smtp.gmail.com',
                                'username' => 'sabra331990@gmail.com',
                                'password' => 'look!tome159',
                                'port' => '587',
                                'encryption' => 'tls',
                                ],
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
        'db' => $db,
   
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
    
    ],
    'as beforeRequest' => [
        'class' => 'app\components\LanguageHandler',
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
    ];
}

return $config;
