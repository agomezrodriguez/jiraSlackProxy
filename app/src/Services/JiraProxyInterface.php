<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 16:25
 */

namespace I4Proxy\Services;

use Slim\Http\Request;
use Slim\Http\Response;

interface JiraProxyInterface
{
    function handleRequest(Request $req, Response $res);

    function forwardRequest(array $request);

}
