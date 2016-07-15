<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 13/07/16
 * Time: 13:56
 */

require 'vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$container = new \Slim\Container($configuration);

$app = new \Slim\App($container);

// Set up dependencies
require 'app/dependencies.php';

// Register routes
require 'app/routes.php';

// Run app
$app->run();
