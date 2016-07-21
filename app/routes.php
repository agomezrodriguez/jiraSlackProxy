<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 14/07/16
 * Time: 09:51
 */

// Define app routes
$app->group('/jira', function () {
    $this->post('/slack', function (\Slim\Http\Request $request, \Slim\Http\Response $response) {
        $jiraProxyService = $this->get('JiraProxyService');
        /** @var \I4Proxy\Services\JiraProxyService $jiraProxyService */
        $matchedRoute = $jiraProxyService->handleRequest($request, $response);
        $jiraEvent = $this->get($matchedRoute);
        //$data = $jiraProxyService->unifyRequestData($req, $args);
        $parsedData = $jiraEvent->formatDataToSlack($request);
        $response = $jiraProxyService->forwardRequest($parsedData);
        return $response;
    });
});
