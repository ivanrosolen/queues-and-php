<?php

namespace Xuplau\AMQPWrapper;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Connection
{
    protected $connection;
    protected $channel;

    public function __construct($host, $vhost)
    {
        $url = parse_url($host);

        $this->connection = new AMQPStreamConnection($url['host'], $url['port'], $url['user'], $url['pass'], $vhost);
        $this->channel    = $this->connection->channel();

    }

    public function shutdown()
    {
        $this->channel->close();
        $this->connection->close();
    }

    public function publish(AMQPMessage $message, $exchange) {
        $this->channel->basic_publish($message, $exchange);
        $this->shutdown();
    }

    public function consume($queue) {
        $this->channel->basic_consume($queue, 'tdc-demo', false, false, false, false, array($this, 'readMessage'));
        register_shutdown_function(array($this,'shutdown'));

        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }

    public function readMessage(AMQPMessage $message) {

        echo "\n--------\n";
        echo $message->body;
        echo "\n--------\n";

        $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);

    }

}