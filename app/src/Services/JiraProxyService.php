<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 08:31
 */

namespace I4Proxy\Services;


use I4Proxy\Utils\I4Proxy3PMapper;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class JiraProxyService implements JiraProxyInterface
{
    /** @var LoggerInterface $logger */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return static
     */
    public function handleRequest(Request $req, Response $res)
    {
        $data = $req->getParsedBody();
        if (!is_array($data)) {
            $this->logger->error("Bad request");
            return $res->withStatus(400)->write('Bad Request');
        }

        //Hierarchical list. First element matched triggers an event
        $exclusiveTriggersList = I4Proxy3PMapper::$jiraMapper;
        
        if (isset($data['webhookEvent']) && array_key_exists($data['webhookEvent'], $exclusiveTriggersList)) {
            $this->logger->info("webhookEvent: " . $data['webhookEvent']);
            return $exclusiveTriggersList[$data['webhookEvent']];
        }
        $this->logger->error("No action matched in i4proxy");
        return $res->withStatus(400)->write('No action matched in i4proxy');
    }

    /**
     * @param $data
     * @param $projectKeyName
     * @return array
     */
    public function unifyRequestData($data, $args)
    {
        $data = $data->getParsedBody();
        return array_merge($data, (array)$args);
    }
    
    public function forwardRequest(array $request)
    {
        
    }

}