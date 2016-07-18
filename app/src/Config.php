<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 15/07/16
 * Time: 19:20
 */

namespace I4Proxy\App;

class Config {

    static function getJiraSlackMapper()
    {
        //Mapper between Jira key projects and Slack rooms name
        return [
            'AK' => 'i4proxy_test'
        ];
    }
}