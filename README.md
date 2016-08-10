# JiraSlackProxy
```
 ________________
< I Route Jira comments to Slack >
 ----------------
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||
```

## Prerequisites
It is needed to setup a webhook in Jira.

Url: http://your-domain.com/jira/slack?project_key=${project.key}&comment_id=${comment.id}&issue_id=${issue.id}&issue_key=${issue.key}

Check: comments created, comments updated, coments deleted

## Installation
Edit app/config.php file with your Jira webhook URL, Slack channelId and an array with Jira Projects key names and Slack room names

