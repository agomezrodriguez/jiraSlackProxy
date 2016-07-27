<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 26/07/16
 * Time: 11:16
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\HttpClientService;
use Slim\Collection;

class CommentDeleted extends AbstractComment
{
    const COMMENT_DELETED = 'deleted a comment';

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
        return str_replace(self::ACTION, self::COMMENT_DELETED, $message);
    }

}
