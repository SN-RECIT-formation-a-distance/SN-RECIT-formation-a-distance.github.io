<?php

date_default_timezone_set("America/New_York");

$filename = sprintf("releases/%s", (isset($_REQUEST['f']) ? $_REQUEST['f'] : 'inconnu'));

$fileLog = 'releases/access.log';
$content = file_get_contents($fileLog);
$content .= sprintf("%s;$filename;%s;%s%s", date(DATE_RFC2822), $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR'], chr(10));
file_put_contents($fileLog, $content, LOCK_EX);

if((file_exists($filename)) && ($filename != $fileLog)){
    header("Location: $filename");
}
else{
    die("Le fichier demandé n'existe pas.");
}