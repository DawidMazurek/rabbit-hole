<?php


namespace RabbitHole\RabbitMq\Connection;


use DRabbitHole\RabbitMq\State\TcpClosed;
use DRabbitHole\RabbitMq\State\TcpEstablished;
use DRabbitHole\RabbitMq\State\TcpListen;
use RabbitHole\RabbitMq\State\TcpState;

abstract class TCPConnection
{

    /**
     * @var TcpState
     */
    protected $TCPState;

    /**
     * @param TcpState $TCPState
     */
    public function __construct(TcpState $TCPState)
    {
        $this->TCPState = $TCPState;
    }

    /**
     *
     */
    public function open()
    {
        $this->TCPState->open($this);
    }

    /**
     *
     */
    public function close()
    {
        $this->TCPState->close($this);
    }

    /**
     *
     */
    public function listen()
    {
        $this->TCPState->listen($this);
    }

    /**
     * @param TcpState $TCPState
     */
    public function changeState(TcpState $TCPState)
    {

        switch(true) {
            case $TCPState instanceof TcpClosed:
                $this->close();
                break;

            case $TCPState instanceof TcpEstablished:
                $this->open();
                break;

            case $TCPState instanceof TcpListen:
                $this->listen();
                break;
        }

        $this->TCPState = $TCPState;
    }

    /**
     * @return TcpState
     */
    public function getState()
    {
        return $this->TCPState;
    }
}
