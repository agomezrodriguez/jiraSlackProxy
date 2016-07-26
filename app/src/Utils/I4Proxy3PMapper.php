<?php
/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 18/07/16
 * Time: 10:16
 */

namespace I4Proxy\Utils;

//Class for mapping third parties action names with our internal class names
class I4Proxy3PMapper
{
    //Mapper between JIra webhookEvent names and I4Proxy dependency inyection container
    static $jiraMapper = [
        'comment_created' => 'JiraCommentCreated',
        'comment_updated' => 'JiraCommentUpdated',
        'comment_deleted' => 'JiraCommentDeleted',
        //'jira:issue_updated' => 'JiraIssueUpdated'
    ];
    
}