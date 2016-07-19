<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 18/07/16
 * Time: 20:14
 */

namespace I4Proxy\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;

class HttpClientAbstract
{
    const BOT_NAME = 'bob';

    /** @var  Client $httpClient */
    private $httpClient;
    private $config;
    private $logger;

    public function __construct(Client $httpClient, array $config, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
        $this->logger = $logger;
    }

    function postToSlack($key, $text)
    {
        $channel = $this->config['jiraSlackMapper'][$key]['channel'];
        $endpoint = $this->config['jiraSlackMapper'][$key]['endpoint'];

        //TODO test a wrong api call
        $payload = json_encode([
            'channel' => $channel,
            'text' => $text,
            'username' => self::BOT_NAME
        ]);

        try{
            $this->httpClient->post($endpoint, ['body' => $payload]);
        //TODO move to logger
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }
}
