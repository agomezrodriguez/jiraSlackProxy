<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 14/07/16
 * Time: 09:51
 */

// Define app routes
$app->group('/jira', function () {
    $this->post('/slack/{key}', function ($req, $res, $args) {
    $jiraProxyService = $this->get('JiraProxyService');
        $response = $jiraProxyService->handleRequest($req, $res, $args);
        return $response;
    });
});