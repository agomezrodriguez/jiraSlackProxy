<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 26/07/16
 * Time: 09:37
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\ArrayPicker;
use I4Proxy\Utils\HttpClientAbstract;
use Slim\Collection;
use Slim\Http\Request;

abstract class AbstractComment implements JiraTriggerInterface
{
    const ACTION = '@@action@@';

    protected $httpClientAbstract;
    protected $config;

    /**
     * CommentCreated constructor.
     * @param HttpClientAbstract $httpClientAbstract
     * @param Collection $config
     */
    public function __construct(HttpClientAbstract $httpClientAbstract, Collection $config)
    {
        $this->httpClientAbstract = $httpClientAbstract;
        $this->config = $config;
    }

    /**
     * @param Request $request
     */
    public function forwardRequest(Request $request)
    {
        $message = $this->buildDataMessage($request);
        $message = $this->customizeDataMessage($message);
        $this->httpClientAbstract->postToSlack($request, $message);
    }

    /**
     * @param array $data
     * @return array
     */
    public function formatMessage(array $data)
    {
        $data = new ArrayPicker($data);
        $comment = new ArrayPicker($data);
        $author = new ArrayPicker($comment);
        
        return "*" . $author->get('displayName') . "* " . self::ACTION ." on <" . $data->get('commentLink') . "|" . $data->get('issueKey') . ">\n\n ```" .
            $comment->get('body') . "``` \n\n <" . $data->get('addLink') . "|Add comment>";    }

    /**
     * @param Request $request
     * @return array
     */
    public function buildDataMessage(Request $request)
    {
        $queryParams = $request->getQueryParams();
        $data = $request->getParsedBody();
        $jiraBaseUrl = $this->config->get('jiraBaseUrl');
        $commentLink = $jiraBaseUrl . '/browse/' . $queryParams['issue_key'] .'#comment-' . $queryParams['comment_id'];
        $addLink = $jiraBaseUrl . '/browse/' . $queryParams['issue_key'] .'#add-comment';
        $data['commentLink'] = $commentLink;
        $data['addLink'] = $addLink;
        $data['issueKey'] = $queryParams['issue_key'];
        return $this->formatMessage($data);
    }
    
}
