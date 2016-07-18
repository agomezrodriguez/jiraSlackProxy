<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 19:03
 */

namespace I4Proxy\Events\Jira;

use Psr\Log\LoggerInterface;

class CommentCreated implements JiraTriggerInterface
{
    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function formatDataToSlack(array $data)
    {
        print_r($data);

    }
}
