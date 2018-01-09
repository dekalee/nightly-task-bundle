<?php

namespace tests\Dekalee\NightlyTaskBundle\Bag;

use Dekalee\NightlyTaskBundle\Bag\TasksBag;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;

class TasksBagTest extends TestCase
{
    /**
     * @var TasksBag
     */
    protected $bag;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->bag = new TasksBag();
    }

    /**
     * Test get tasks with priority
     */
    public function testGetTaskWithPriority()
    {
        $command1 = $this->createMock(Command::CLASS);
        $command2 = $this->createMock(Command::CLASS);
        $command3 = $this->createMock(Command::CLASS);

        $this->bag->addTask($command1, 10);
        $this->bag->addTask($command2, 20);
        $this->bag->addTask($command3, 20);

        $this->assertSame([
            20 => [
                $command2,
                $command3
            ],
            10 => [
                $command1
            ]
        ], $this->bag->getTasks());
    }
}
