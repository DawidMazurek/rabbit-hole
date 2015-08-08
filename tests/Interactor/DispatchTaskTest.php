<?php

namespace DawidMazure\tests\Interactor;


use RabbitHole\Interactor\DispatchTask;

class SaveTaskTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var DispatchTask
     */
    private $dispatchTaskInteractor;

    /**
     *
     */
    public function setUp()
    {
        $taskInterfaceMock = $this->getMock('\RabbitHole\Task\TaskInterface');

        $taskRepositoryMock = $this->getMockBuilder('\RabbitHole\Repository\TaskRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $taskRepositoryMock
            ->expects($this->any())
            ->method('dispatchTask')
            ->willReturn(true);

        $this->dispatchTaskInteractor = new DispatchTask($taskInterfaceMock, $taskRepositoryMock);
    }

    /**
     *
     */
    public function testInteractor()
    {
        $this->assertInstanceOf(
            '\RabbitHole\Interactor\DispatchTask',
            $this->dispatchTaskInteractor,
            'DispatchTask interactor is wrong type');
        $this->assertTrue($this->dispatchTaskInteractor->execute(), 'DispatchTask interactor execute failed');
    }

    /**
     *
     */
    public function tearDown()
    {
        unset($this->dispatchTaskInteractor);
    }
}
