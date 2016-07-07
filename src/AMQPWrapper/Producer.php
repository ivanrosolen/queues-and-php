<?php

namespace Xuplau\AMQPWrapper;

use Xuplau\AMQPWrapper\Connection;
use PhpAmqpLib\Message\AMQPMessage;

class Producer
{
    protected $amqp;

    public function __construct(Connection $amqp)
    {
        $this->amqp = $amqp;
    }

    public function send($message, $exchange)
    {
        $message = new AMQPMessage($message, array('content_type' => 'text/plain',
                                                   'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
        $this->amqp->publish($message, $exchange);
    }
}