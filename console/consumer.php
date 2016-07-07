<?php

require_once realpath(__DIR__.'/../vendor/autoload.php');

use Xuplau\AMQPWrapper\Connection;
use Xuplau\AMQPWrapper\Consumer;

define('SETTINGS_INI',  realpath(__DIR__.'/../config/settings.ini'));

$config = parse_ini_file(SETTINGS_INI);

$connection = new Connection($config['HOST'], $config['VHOST']);
$consumer   = new Consumer($connection);

$consumer->run($config['QUEUE']);