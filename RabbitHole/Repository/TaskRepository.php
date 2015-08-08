<?php

namespace RabbitHole\Repository;

use RabbitHole\Gateway\TaskGatewayInterface;
use RabbitHole\Task\TaskInterface;

class TaskRepository
{

    /**
     * @var TaskGatewayInterface
     */
    private $taskGateway;

    /**
     * @param TaskGatewayInterface $taskGateway
     */
    public function __construct(TaskGatewayInterface $taskGateway)
    {
        $this->taskGateway = $taskGateway;
    }

    /**
     * @param TaskInterface $task
     * @return bool
     */
    public function dispatchTask(TaskInterface $task)
    {
        return $this->taskGateway->dispatch($task);
    }

    /**
     * @param string $queueName
     */
    public function getTaskByQueueName($queueName)
    {

    }
}
