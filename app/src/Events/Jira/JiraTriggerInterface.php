<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 18/07/16
 * Time: 11:24
 */

namespace I4Proxy\Events\Jira;

use Slim\Http\Request;

interface JiraTriggerInterface
{
    public function formatDataToSlack(Request $request);

}