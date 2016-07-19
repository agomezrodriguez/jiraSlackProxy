<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 19:03
 */

namespace I4Proxy\Events\Jira;

use GuzzleHttp\Client;
use I4Proxy\Utils\HttpClientAbstract;
use I4Proxy\Utils\Utils;
use Psr\Log\LoggerInterface;

class CommentCreated implements JiraTriggerInterface
{
    private $httpClientAbstract;

    public function __construct(HttpClientAbstract $httpClientAbstract)
    {
        $this->httpClientAbstract = $httpClientAbstract;
    }
    
    public function formatDataToSlack(array $data)
    {
        $text = 'this is a test';
        $response = $this->httpClientAbstract->postToSlack($data['key'], $text);
        print_r($response);exit;
    }
}
