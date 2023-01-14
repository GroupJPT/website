<?php

use yii\web\JsonParser;

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
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\Module',
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => JsonParser::class
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
                '/login' => 'site/login',

                // API ROUTES: GUEST
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/guest',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET login' => 'occurrences',
                    ]
                ],

                // API ROUTES: USER
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/user',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET view' => 'occurrences',
                        'GET update' => 'occurrences',
                    ]
                ],

                // API ROUTES: OCCURRENCE
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/occurrence',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET occurrences' => 'occurrences',
                    ]
                ],

                // API ROUTES: SUGGESTION
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/suggestion',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET x' => 'x',
                    ]
                ],

                // API ROUTES: CATEGORY
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/category',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET x' => 'x',
                    ]
                ],

                // API ROUTES: SUBCATEGORY
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/subcategory',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET x' => 'x',
                    ]
                ],

                // API ROUTES: WARNING
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/warning',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET occurrences' => 'occurrences',
                    ]
                ],

                // API ROUTES: CONTACT
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/warning',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET occurrences' => 'occurrences',
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];
