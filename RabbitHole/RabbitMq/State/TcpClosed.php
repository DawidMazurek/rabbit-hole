<?php


namespace DRabbitHole\RabbitMq\State;


use RabbitHole\RabbitMq\Connection\TCPConnection;
use RabbitHole\RabbitMq\State\TcpState;

class TcpClosed extends TcpState
{
    /**
     * @param TCPConnection $TCPConnection
     */
    public function open(TCPConnection $TCPConnection)
    {
        $this->changeState($TCPConnection, TcpEstablished::instance());
    }

    /**
     * @param TCPConnection $TCPConnection
     */
    public function close(TCPConnection $TCPConnection)
    {

    }

    /**
     * @param TCPConnection $TCPConnection
     */
    public function listen(TCPConnection $TCPConnection)
    {
        $this->changeState($TCPConnection, TcpEstablished::instance());
        $this->changeState($TCPConnection, TcpListen::instance());
    }
}
