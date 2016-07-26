<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 26/07/16
 * Time: 09:37
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\HttpClientAbstract;
use Slim\Collection;
use Slim\Http\Request;

abstract class AbstractComment implements JiraTriggerInterface
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
        $this->httpClientAbstract = $httpClientAbstract;
        $this->config = $config;
    }

    /**
     * @param Request $request
     */
    public function forwardRequest(Request $request)
    {
        $message = $this->formatMessage($request);
        $this->httpClientAbstract->postToSlack($request, $message);
    }

    public function formatMessage(Request $request)
    {

    }

    
}
