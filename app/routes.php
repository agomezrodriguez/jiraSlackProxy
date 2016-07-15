<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 14/07/16
 * Time: 09:51
 */

// Define app routes
$app->group('/slackify', function () {
$this->post('/jira/{key}', function ($req, $res, $args) {
$response = $this->get('JiraProxy');
return $response;
});
});