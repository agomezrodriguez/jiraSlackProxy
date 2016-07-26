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
    const COMMENT_CREATED = 'commented';

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
     * @param $message
     * @return mixed
     */
    public function customizeDataMessage($message)
    {
        return str_replace(self::ACTION, self::COMMENT_CREATED, $message);
    }
    
}

