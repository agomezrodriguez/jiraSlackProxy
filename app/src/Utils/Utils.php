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

class Utils
{
    const BOT_NAME = 'bob';
    static function postToSlack(Client $httpClient, $endpoint, $channel, $text)
    {
        //TODO test a wrong api call
        $payload = json_encode([
            'channel' => $channel,
            'text' => $text,
            'username' => self::BOT_NAME
        ]);

        try{
            $httpClient->post($endpoint, ['body' => $payload]);
        //TODO move to logger
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }
}