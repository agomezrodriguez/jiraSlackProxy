<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 26/07/16
 * Time: 10:14
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\HttpClientService;
use Slim\Collection;

class CommentUpdated extends AbstractComment
{
    const COMMENT_UPDATED = 'updated a comment';

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
        return str_replace(self::ACTION, self::COMMENT_UPDATED, $message);
    }

}
