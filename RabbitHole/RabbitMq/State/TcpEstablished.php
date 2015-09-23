<?php


namespace DRabbitHole\RabbitMq\State;


use RabbitHole\RabbitMq\Connection\TCPConnection;
use RabbitHole\RabbitMq\State\TcpState;

class TcpEstablished extends TcpState
{
    /**
     * @param TCPConnection $TCPConnection
     */
    public function open(TCPConnection $TCPConnection)
    {

    }

    /**
     * @param TCPConnection $TCPConnection
     */
    public function close(TCPConnection $TCPConnection)
    {
        $this->changeState($TCPConnection, TcpClosed::instance());
    }

    /**
     * @param TCPConnection $TCPConnection
     */
    public function listen(TCPConnection $TCPConnection)
    {
        $this->changeState($TCPConnection, TcpListen::instance());
    }
}
