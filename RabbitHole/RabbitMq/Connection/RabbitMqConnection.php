<?php


namespace RabbitHole\RabbitMq\Connection;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use RabbitHole\Service\QueueMapper;

class RabbitMqConnection extends TCPConnection
{

    /**
     * @var AMQPStreamConnection
     */
    protected $connection;

    /**
     * @var AMQPChannel
     */
    protected $channel;

    /**
     * @var QueueMapper
     */
/*    protected $queueMapper;

    public function __construct(QueueMapper $queueMapper) {
        $this->queueMapper = $queueMapper;
    }
*/
    public function connect() {
        // move to factory
        $this->connection = new AMQPStreamConnection('192.168.0.103', '5672', 'guest', 'guest', '/' );
        $this->channel = $this->connection->channel();
        $this->channel->basic_qos(null, 1, null);
    }

/*
$channel->queue_declare('hello', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg){
    echo " [x] Received ", $msg->body, "\n";
    sleep(substr_count($msg->body, '.'));
    echo " [x] Done", "\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};



$channel->basic_qos(null, 1, null);
$channel->basic_consume('hello', '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
$channel->wait(null, false, 5);
}
*/


    public function listen() {
        $this->bindQueues();
        $this->bindCallbacks();
    }

    private function bindQueues() {
        foreach($this->queueMapper->getBindingMapping() as $bindingMapping) {
            $this->channel->queue_declare(
                $bindingMapping->queueName,
                $bindingMapping->passive,
                $bindingMapping->durable,
                $bindingMapping->exclusive,
                $bindingMapping->auto_delete,
                $bindingMapping->no_wait,
                $bindingMapping->arguments,
                $bindingMapping->ticket
            );
        }
    }

    private function bindCallbacks() {
        foreach($this->queueMapper->getBindingMapping() as $bindingMapping) {
            $this->channel->basic_consume(
                $bindingMapping->queueName,
                '',
                false,
                false,
                false,
                false,
                $this->queueCallbackFactory->create($bindingMapping->queueName)
            );
        }
    }

    public function disconnect() {
        $this->channel->close();
        $this->connection->close();
    }
}