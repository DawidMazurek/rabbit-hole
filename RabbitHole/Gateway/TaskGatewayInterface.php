<?php

namespace RabbitHole\Gateway;

use RabbitHole\Service\QueueMapper;
use RabbitHole\Task\TaskInterface;

interface TaskGatewayInterface {

    /**
     * @param TaskInterface $task
     * @return bool
     */
    public function store(TaskInterface $task);

    /**
     * @param QueueMapper $queueMapper
     * @return \Generator
     */
    public function get(QueueMapper $queueMapper);
}
