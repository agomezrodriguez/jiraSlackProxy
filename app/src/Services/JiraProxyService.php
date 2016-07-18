<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 08:31
 */

namespace I4Proxy\Services;

use Slim\Http\Request;
use Slim\Http\Response;

class JiraProxyService //extends AbstractProxy
{
    const JIRA_NAMESPACE = '\I4Proxy\Events\Jira\\';

    public function handleRequest(Request $req, Response $res, $args = [])
    {
        $request = $req->getParsedBody();
        if (!is_array($request)) {
            return $res->withStatus(400)->write('Bad Request');
        }

        //Hierarchical list. First element matched triggers an event
        $exclusiveTriggersList = [
            'comment_created' => 'CommentCreated',
            'jira:issue_updated' => 'IssueUpdated'
        ];
        foreach($request as $item) {
            if (isset($item['webhookEvent']) && array_key_exists($item['webhookEvent'], $exclusiveTriggersList)) {
                $class = self::JIRA_NAMESPACE . $exclusiveTriggersList[$item['webhookEvent']];
                return new $class($args);
            }
        }
        return $res->withStatus(400)->write('No action matched in i4proxy');


    }
    
    public function forwardRequest($request)
    {
        
    }

}