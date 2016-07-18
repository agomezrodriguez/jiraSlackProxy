<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 14/07/16
 * Time: 09:53
 */

// DIC configuration
$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));
    return $logger;
};

$container['JiraProxyService'] = function ($c) {
    $jiraProxyService = new \I4Proxy\Services\JiraProxyService($c->get('logger'));
    return $jiraProxyService;
};

$container['JiraCommentCreated'] = function ($c) {
    $jiraProxyService = new \I4Proxy\Events\Jira\CommentCreated($c->get('logger'));
    return $jiraProxyService;
};
