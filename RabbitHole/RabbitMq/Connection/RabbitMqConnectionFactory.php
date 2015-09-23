<?php


namespace RabbitHole\RabbitMq\Connection;


use DRabbitHole\RabbitMq\State\TcpClosed;
use DRabbitHole\RabbitMq\State\TcpEstablished;
use DRabbitHole\RabbitMq\State\TcpListen;
use RabbitHole\RabbitMq\State\TcpState;
use RabbitHole\Service\QueueMapper;
use InvalidArgumentException;

class RabbitMqConnectionFactory
{

    /**
     * @param TcpState $tcpState
     * @return RabbitMqConnection
     */
    public function build(TcpState $tcpState)
    {
        $queueMapper = new QueueMapper();
        switch(true) {
            case $tcpState instanceof TcpEstablished:
            case $tcpState instanceof TcpListen:
            case $tcpState instanceof TcpClosed:
                $rabbitMqConnection = new RabbitMqConnection(new TcpClosed());
                $rabbitMqConnection->changeState($tcpState);

                break;

            default:
                throw new InvalidArgumentException('RabbitMqConnection created with unsupported TcpState');
        }

        return $rabbitMqConnection;
    }
}