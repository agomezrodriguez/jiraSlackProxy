<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 18/07/16
 * Time: 11:24
 */

namespace I4Proxy\Events\Jira;

interface JiraTriggerInterface
{
    public function formatDataToSlack(array $data);

}