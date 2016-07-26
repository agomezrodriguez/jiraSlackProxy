<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 26/07/16
 * Time: 10:14
 */

namespace I4Proxy\Events\Jira;

use I4Proxy\Utils\HttpClientAbstract;
use Slim\Collection;
use Slim\Http\Request;

class CommentUpdated extends AbstractComment
{
    const COMMENT_UPDATED = 'updated a comment';

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
        return str_replace(self::ACTION, self::COMMENT_UPDATED, $message);
    }

}
