<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'params' => $params,
    'controllerMap' => [
//        'fixture' => [ // Fixture generation command line.
//            'class' => 'yii\faker\FixtureController',
//        ],
        'seeder' => [
            'class' => \diecoding\seeder\SeederController::class,


            /** @var string the default command action. */
//            'defaultAction' => 'seed',

            /** @var string seeder path, support path alias */
            'seederPath' => 'seeders',

            /** @var string seeder namespace */
            'seederNamespace' => 'app\seeders',

            /**
             * @var string this class look like `$this->seederNamespace\Seeder`
             * default seeder class run if no class selected,
             * must instance of `\diecoding\seeder\TableSeeder`
             */
//            'defaultSeederClass' => 'Seeder',

            /** @var string tables path, support path alias */
            'tablesPath' => 'seeders',

            /** @var string seeder table namespace */
            'tableSeederNamespace' => 'app\seeders',

            /** @var string model namespace */
            'modelNamespace' => 'app\models',

            /** @var string path view template table seeder, support path alias */
            'templateSeederFile' => '@vendor/diecoding/yii2-seeder/src/views/Seeder.php',

            /** @var string path view template seeder, support path alias */
            'templateTableFile' => '@vendor/diecoding/yii2-seeder/src/views/TableSeeder.php'
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
