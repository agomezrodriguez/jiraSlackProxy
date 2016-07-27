<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 19:03
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\HttpClientService;
use Slim\Collection;

class CommentCreated extends AbstractComment
{
    const COMMENT_CREATED = 'commented';

    protected $HttpClientService;
    protected $config;

    /**
     * CommentCreated constructor.
     * @param HttpClientService $HttpClientService
     * @param Collection $config
     */
    public function __construct(HttpClientService $HttpClientService, Collection $config)
    {
        parent::__construct($HttpClientService, $config);
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

