<?php

require_once realpath(__DIR__.'/../vendor/autoload.php');

use Xuplau\AMQPWrapper\Connection;
use Xuplau\AMQPWrapper\Producer;

define('SETTINGS_INI',  realpath(__DIR__.'/../config/settings.ini'));

$config = parse_ini_file(SETTINGS_INI);

$connection = new Connection($config['HOST'], $config['VHOST']);
$producer   = new Producer($connection);

$message = implode(' ', array_slice($argv, 1));
if(empty($message)) $message = 'Xuplau';

$producer->send($message, $config['EXCHANGE']);