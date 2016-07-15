<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 14/07/16
 * Time: 09:51
 */

use I4Proxy\Services\JiraProxyService;

// Define app routes
$app->group('/jira', function () {
$this->post('/slack/{key}', function ($req, $res, $args) {
    $jiraProxyService = new JiraProxyService();
    $response = $jiraProxyService->handleRequest($req, $args);
return $response;
});
});