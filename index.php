<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 13/07/16
 * Time: 13:56
 */

require 'vendor/autoload.php';

$settings = require 'app/settings.php';

$app = new \Slim\App($settings);

// Set up dependencies
require 'app/dependencies.php';

// Register routes
require 'app/routes.php';

// Run app
$app->run();
