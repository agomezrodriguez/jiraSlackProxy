<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 19:03
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\HttpClientAbstract;
use Slim\Collection;
use Slim\Http\Request;

class CommentCreated extends AbstractComment
{
    protected $httpClientAbstract;
    protected $config;

    /**
     * CommentCreated constructor.
     * @param HttpClientAbstract $httpClientAbstract
     * @param Collection $config
     */
    public function __construct(HttpClientAbstract $httpClientAbstract, Collection $config)
    {
        parent::__construct($httpClientAbstract, $config);
    }

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

    /**
     * @param Request $request
     */
    public function forwardRequest(Request $request)
    {
        $message = $this->formatMessage($request);
        $this->httpClientAbstract->postToSlack($request, $message);
    }
}

