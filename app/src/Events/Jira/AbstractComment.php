<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 26/07/16
 * Time: 09:37
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\ArrayPicker;
use I4Proxy\Utils\HttpClientService;
use Slim\Collection;
use Slim\Http\Request;

abstract class AbstractComment implements JiraTriggerInterface
{
    const ACTION = '@@action@@';

    protected $HttpClientService;
    protected $config;

    /**
     * CommentCreated constructor.
     * @param HttpClientService $HttpClientService
     * @param Collection $config
     */
    public function __construct(HttpClientService $HttpClientService, Collection $config)
    {
        $this->HttpClientService = $HttpClientService;
        $this->config = $config;
    }

    /**
     * @param Request $request
     */
    public function forwardRequest(Request $request)
    {
        $message = $this->buildDataMessage($request);
        $message = $this->customizeDataMessage($message);
        $this->HttpClientService->postToSlack($request, $message);
    }

    /**
     * @param array $data
     * @return array
     */
    public function formatMessage(array $data)
    {
        $commentLink = ArrayPicker::get($data, 'commentLink');
        $issueKey = ArrayPicker::get($data, 'issueKey');
        $addLink = ArrayPicker::get($data, 'addLink');
        $body = ArrayPicker::get($data, 'comment.body');
        $displayName = ArrayPicker::get($data, 'comment.author.displayName');

        return "*" . $displayName . "* " . self::ACTION ." on <" . $commentLink . "|" . $issueKey . ">\n\n ```" . $body . "``` \n\n <" . $addLink . "|Add comment>";
    }

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
