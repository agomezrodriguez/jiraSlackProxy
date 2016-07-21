<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 14/07/16
 * Time: 09:51
 */

// Define app routes
$app->group('/jira', function () {
    $this->post('/slack', function (\Slim\Http\Request $req, \Slim\Http\Response $res, $args) {
        $jiraProxyService = $this->get('JiraProxyService');
        /** @var \I4Proxy\Services\JiraProxyService $jiraProxyService */
        $matchedRoute = $jiraProxyService->handleRequest($req, $res);
        $jiraRoute = $this->get($matchedRoute);
        //$data = $jiraProxyService->unifyRequestData($req, $args);
        $parsedData = $jiraRoute->formatDataToSlack($req, $args);
        $response = $jiraProxyService->forwardRequest($parsedData);
        return $response;
    });
});
