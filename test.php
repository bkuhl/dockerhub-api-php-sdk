<?php

require_once 'vendor/autoload.php';

$dockerhub = new \DockerHub\DockerHub('bkuhl', '3nTcmMEG!Y');

var_dump($dockerhub->repositories('bkuhl'));
exit;

//$tags = $dockerhub->repository('library/mysql')->tags();
//foreach ($tags->results as $tag) {
//    echo $tag->name.PHP_EOL;
//}
//exit;