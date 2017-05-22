<?php

require_once 'vendor/autoload.php';

$dockerhub = new \DockerHub\DockerHub('bkuhl', '3nTcmMEG!Y');

//var_dump($dockerhub->repository('bkuhl/test3')->create());
//exit;

var_dump($dockerhub->repository('bkuhl/game-watcher')->tags());
exit;