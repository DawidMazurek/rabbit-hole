<?php

namespace RabbitHole\Gateway;


use RabbitHole\Task\TaskInterface;

interface TaskGatewayInterface {

    /**
     * @param TaskInterface $task
     * @return bool
     */
    public function dispatch(TaskInterface $task);
}
