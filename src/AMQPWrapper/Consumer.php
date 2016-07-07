<?php

namespace Xuplau\AMQPWrapper;

use Xuplau\AMQPWrapper\Connection;
use PhpAmqpLib\Message\AMQPMessage;

class Consumer
{
    protected $amqp;

    public function __construct(Connection $amqp)
    {
        $this->amqp = $amqp;
    }

    public function run($queue)
    {
        $this->amqp->consume($queue);
    }

}