<?php


namespace DawidMazure\RabbitHole\Interactor;


use RabbitHole\Repository\TaskRepository;
use RabbitHole\Service\QueueMapper;

class GetQueuedTask {

    /**
     * @var QueueMapper
     */
    protected $queueMapper;

    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * @param QueueMapper $queueMapper
     * @param TaskRepository $taskRepository
     */
    public function __construct(QueueMapper $queueMapper, TaskRepository $taskRepository)
    {
        $this->queueMapper = $queueMapper;
        $this->taskRepository = $taskRepository;
    }

    /**
     * @yield \RabbitHole\Task\TaskInterface
     */
    public function execute()
    {
        return $this->taskRepository->getTasks($this->queueMapper);
    }
}
