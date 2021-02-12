<?php
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
        'class' => 'backend\api\Module',
        ],
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'csrfParam' => '_csrf-backend',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'api/users',
                        'api/consultas',
                        'api/exame',
                        'api/marcacaoconsultas',
                        'api/marcacaoexames',
                        'api/receita',
                        'api/medicos',
                        'apr/utentes'
                    ],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST signup' => 'signup',
                        'GET total' => 'total',
                        'GET {id}/marcacaoexame' => 'marcacaoexame',
                        'GET {id}/marcacaoconsulta' => 'marcacaoconsulta',
                        'GET {id}/medico' => 'medico',
                        'GET {id}/consulta' => 'consulta',
                        'GET {id}/exame' => 'exame',
                        'GET {id}/receita' => 'receita',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
