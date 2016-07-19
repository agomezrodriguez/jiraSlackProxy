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

//Guzzle HTTP client
$container['httpClient'] = function() {
    $guzzle = new \GuzzleHttp\Client();
    return $guzzle;
};

//TODO switch DI from Pimple to Aura to avoid passing logger object to every controller
// https://blog.shameerc.com/2015/10/automatic-construction-injection-in-slim-3
// https://blog.shameerc.com/2015/09/slim-3-replacing-pimple-with-auradi

$container['JiraProxyService'] = function ($c) {
    $jiraProxyService = new \I4Proxy\Services\JiraProxyService($c->get('logger'));
    return $jiraProxyService;
};

$container['HttpClientAbstract'] = function ($c) {
    $settings = $c->get('settings');
    $httpClientAbstract = new \I4Proxy\Utils\HttpClientAbstract(
        $c->get('httpClient'),
        $settings['i4proxy'],
        $c->get('logger')
    );
    return $httpClientAbstract;
};

$container['JiraCommentCreated'] = function ($c) {
    $jiraProxyService = new \I4Proxy\Events\Jira\CommentCreated(
        $c->get('HttpClientAbstract')
    );
    return $jiraProxyService;
};
