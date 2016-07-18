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
        /** @var \I4Proxy\Services\JiraProxyService $jiraProxyService */
        $matchedRoute = $jiraProxyService->handleRequest($req, $res, $args);
        $data = $jiraProxyService->unifyRequestData($req, $args);
        $jiraRoute = $this->get($matchedRoute);
        $parsedData = $jiraRoute->formatDataToSlack($data);
        $response = $jiraProxyService->forwardRequest($parsedData);
        return $response;
    });
});