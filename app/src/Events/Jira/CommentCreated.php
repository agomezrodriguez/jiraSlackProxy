<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 19:03
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\HttpClientAbstract;
use I4Proxy\Utils\Utils;
use Slim\Http\Request;

class CommentCreated implements JiraTriggerInterface
{
    private $httpClientAbstract;

    public function __construct(HttpClientAbstract $httpClientAbstract)
    {
        $this->httpClientAbstract = $httpClientAbstract;
    }
    
    public function formatDataToSlack(array $data, Request $request)
    {
        $queryParams = $request->getQueryParams();
        $jiraCommentEndpoint = $data['comment']['self'];
        $jiraIssueEndpoint = preg_replace('@/comment/\d+@', '', $jiraCommentEndpoint);
        $link = 'https://interactiv4.atlassian.net/browse/' . $queryParams['issue_id'] .'#comment-' . $queryParams['comment_id'];
        $message = $data['comment']['updateAuthor']['name'] . ' commented<br> ' . $data['comment']['body'] . '<br>in ' .$link ;
        $slackResponse = $this->httpClientAbstract->postToSlack($data, $message);
    }
}
