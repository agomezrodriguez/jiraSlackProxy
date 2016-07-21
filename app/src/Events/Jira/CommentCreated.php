<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 19:03
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\HttpClientAbstract;
use Slim\Http\Request;

class CommentCreated implements JiraTriggerInterface
{
    private $httpClientAbstract;
    private $config;

    public function __construct(HttpClientAbstract $httpClientAbstract, array $config)
    {
        $this->httpClientAbstract = $httpClientAbstract;
        $this->config = $config;
    }
    
    public function formatDataToSlack(Request $request)
    {
        $queryParams = $request->getQueryParams();
        $data = $request->getParsedBody();
        $jiraBaseUrl = $this->config['jiraBaseUrl'];
        $commentLink = $jiraBaseUrl . '/browse/' . $queryParams['issue_key'] .'#comment-' . $queryParams['comment_id'];
        $addLink = $jiraBaseUrl . 'https://interactiv4.atlassian.net/browse/' . $queryParams['issue_key'] .'#add-comment';
        $message = "*" . $data['comment']['author']['displayName'] . "* commented on <" . $commentLink . "|" . $queryParams['issue_key'] . ">\n\n ```" .
            $data['comment']['body'] . "``` \n\n <" . $addLink . "|Add comment>";
        $slackResponse = $this->httpClientAbstract->postToSlack($request, $message);
    }
}
