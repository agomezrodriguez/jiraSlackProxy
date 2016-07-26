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
use Slim\Collection;
use Slim\Http\Request;
use InvalidArgumentException;

class HttpClientAbstract
{
    const BOT_NAME = 'Little Bob';

    /** @var  Client $httpClient */
    private $httpClient;
    private $config;
    private $logger;

    /**
     * HttpClientAbstract constructor.
     * @param Client $httpClient
     * @param Collection $config
     * @param LoggerInterface $logger
     */
    public function __construct(Client $httpClient, Collection $config, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @param $message
     */
    function postToSlack(Request $request, $message)
    {
        $queryParams = $request->getQueryParams();
        $key = $queryParams['project_key'];


        if (!array_key_exists($key, $this->config->get('i4proxy')['jiraSlackMapper'])) {
            $this->logger->error('Invalid project key ' . $key);
            throw new InvalidArgumentException('Invalid project key ' . $key);
        }
        $channel = $this->config->get('i4proxy')['jiraSlackMapper'][$key];
        $endpoint = $this->config->get('slackWebhook');

        $payload = json_encode([
            'channel' => $channel,
            'text' => $message,
            'username' => self::BOT_NAME,
            'unfurl_links' => 'true',
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
