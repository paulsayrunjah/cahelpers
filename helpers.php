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


function mysqlResultToCollection($fetchedAssoc)
{
    $rows = [];
    while($row = $fetchedAssoc->fetch_assoc())
    {
        $rows[] = $row;
    }

    return collect($rows);
}
