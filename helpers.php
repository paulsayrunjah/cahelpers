<?php

use GuzzleHttp\Client;

function logger($content)
{
    try {
        $myfile = fopen("logs.log", "a") or die("Unable to open file!");
        if(is_array($content)) {
            $content = json_encode($content);
        }elseif(is_object($content)) {
            $content = json_encode($content);
        }
        $time =  date("Y-m-d H:i");
        fwrite($myfile, "\n \nDate {$time} \n". $content);
        fclose($myfile);
    }catch (Exception $exception) {

    }
}

function sendSlackMessage($message, $title = "CA Notification", $icon_emoji = null)
{
    try {
        $slack_webHook = "https://hooks.slack.com/services/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";
        $client = new Client([
            'base_url' => $slack_webHook,
        ]);

        $payload = json_encode(
            [
                'channel' => null,
                'username' => null,
                'icon_emoji' => ":smile:",
                "attachments" => [
                    (object)[
                        "title" => $title ,
                        "fallback" => "CA Notification",
                        "color" => "#2eb886",
                        "text" => $message,
                    ]
                ]
            ]
        );
        $response = $client->post($slack_webHook, ['body' => $payload]);
        return $response;
    } catch (Exception $ex) {
        logger($ex);
    }
    return "";
}

function mysqlResultToCollection($fetchedAssoc)
{
    $rows = [];
    while($row = $fetchedAssoc)
    {
        $rows[] = $row;
    }
    dd($rows);
}
