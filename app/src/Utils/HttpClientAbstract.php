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
use Slim\Http\Request;

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

    function postToSlack(Request $request, $message)
    {
        $data = $data = $request->getParsedBody();
        $key = $data['project_key'];
        $channel  = $this->config['jiraSlackMapper'][$key]['channel'];
        $endpoint = $this->config['jiraSlackMapper'][$key]['endpoint'];

        $payload = json_encode([
            'channel' => $channel,
            'text' => $message,
            'username' => self::BOT_NAME
        ]);

        try{
            $this->httpClient->post($endpoint, ['body' => $payload]);
        } catch (RequestException $e) {
            $this->logger->error(print_r(Psr7\str($e->getRequest()),true));
            if ($e->getResponse()) {
                $this->logger->error(print_r(Psr7\str($e->getResponse()),true));
            }
        }
    }
}
