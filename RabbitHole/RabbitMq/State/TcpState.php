<?php


namespace RabbitHole\RabbitMq\State;

use RabbitHole\RabbitMq\Connection\TCPConnection;


abstract class TcpState
{
    /**
     * @param TCPConnection $TCPConnection
     */
    abstract public function open(TCPConnection $TCPConnection);

    /**
     * @param TCPConnection $TCPConnection
     */
    abstract public function close(TCPConnection $TCPConnection);

    /**
     * @param TCPConnection $TCPConnection
     */
    abstract public function listen(TCPConnection $TCPConnection);

    /**
     * @param TCPConnection $TCPConnection
     * @param TcpState $TCPState
     */
    public function changeState(TCPConnection $TCPConnection, TcpState $TCPState)
    {
        $TCPConnection->changeState($TCPState);
    }

    /**
     * @return TcpState
     */
    public static function instance()
    {
        static $instance;
        if (!$instance[__CLASS__] instanceof static) {
            $instance[__CLASS__] = new static;
        }

        return $instance[__CLASS__] ;
    }
}
