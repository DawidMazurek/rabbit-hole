<?php


namespace DRabbitHole\RabbitMq\State;


use RabbitHole\RabbitMq\Connection\TCPConnection;
use RabbitHole\RabbitMq\State\TcpState;

class TcpListen extends TcpState{

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
        $this->changeState($TCPConnection, TcpClosed::instance());
    }

    /**
     * @param TCPConnection $TCPConnection
     */
    public function listen(TCPConnection $TCPConnection)
    {

    }
}
