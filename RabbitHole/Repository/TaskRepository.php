<?php

namespace RabbitHole\Repository;

use RabbitHole\Gateway\TaskGatewayInterface;
use RabbitHole\Task\TaskInterface;
use RabbitHole\Service\QueueMapper;

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
    public function store(TaskInterface $task)
    {
        return $this->taskGateway->store($task);
    }

    /**
     * @param QueueMapper $queueMapper
     * @return \Generator[TaskInterface]
     */
    public function getTasks(QueueMapper $queueMapper)
    {
        foreach($this->taskGateway->get($queueMapper) as $taskObject) {
            yield $taskObject; // yield object with callback to ack/nack
        }
    }
}
