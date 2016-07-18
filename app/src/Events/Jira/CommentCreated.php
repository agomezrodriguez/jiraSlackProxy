<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 19:03
 */

namespace I4Proxy\Events\Jira;

use GuzzleHttp\Client;
use I4Proxy\Utils\Utils;
use Psr\Log\LoggerInterface;

class CommentCreated implements JiraTriggerInterface
{
    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    /** @var Client $httpClient */
    private $httpClient;
    private $jiraSlackMapper;

    public function __construct(LoggerInterface $logger, Client $httpClient, array $jiraSlackMapper)
    {
        $this->logger = $logger;
        $this->httpClient = $httpClient;
        $this->jiraSlackMapper = $jiraSlackMapper;
    }
    
    public function formatDataToSlack(array $data)
    {
        $endpoint = $this->jiraSlackMapper[$data['key']]['endpoint'];
        $channel = $this->jiraSlackMapper[$data['key']]['channel'];
        $text = 'this is a test';
        $response = Utils::postToSlack($this->httpClient, $endpoint, $channel, $text);
        print_r($response);exit;
    }
}
