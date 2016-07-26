<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 26/07/16
 * Time: 10:14
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\HttpClientAbstract;
use Slim\Collection;
use Slim\Http\Request;

class CommentUpdated extends AbstractComment
{
    /**
     * @param Request $request
     * @return string
     */
    public function formatMessage(Request $request)
    {
        $queryParams = $request->getQueryParams();
        $data = $request->getParsedBody();
        $jiraBaseUrl = $this->config->get('jiraBaseUrl');
        $commentLink = $jiraBaseUrl . '/browse/' . $queryParams['issue_key'] .'#comment-' . $queryParams['comment_id'];
        $addLink = $jiraBaseUrl . '/browse/' . $queryParams['issue_key'] .'#add-comment';
        $message = "*" . $data['comment']['author']['displayName'] . "* commented on <" . $commentLink . "|" . $queryParams['issue_key'] . ">\n\n ```" .
            $data['comment']['body'] . "``` \n\n <" . $addLink . "|Add comment>";
        return $message;
    }
    
}
