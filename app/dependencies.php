<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 14/07/16
 * Time: 09:53
 */

// DIC configuration
$c = $app->getContainer();

$container['JiraProxy'] = function ($c) {
    return new \App\Src\Services\JiraProxyService();
};