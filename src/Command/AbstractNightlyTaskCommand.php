<?php

namespace Dekalee\NightlyTaskBundle\Command;

use Dekalee\NightlyTaskBundle\Bag\TasksBag;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Descriptor\ApplicationDescription;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AbstractNightlyTaskCommand
 */
abstract class AbstractNightlyTaskCommand extends ContainerAwareCommand
{
    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var TasksBag
     */
    private $taskBag;

    /**
     * @return array
     */
    protected function getTasks()
    {
        return $this->taskBag->getTasks();
    }

    /**
     * Initialize fields
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function beforeExecute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->logger = $this->getContainer()->get('logger');
        $this->taskBag = $this->getContainer()->get('dekalee_nightly_task.bag.task');
    }

    /**
     * Fill task lists
     */
    protected function fillTasks()
    {
        $description = new ApplicationDescription($this->getApplication());
        foreach ($description->getCommands() as $command) {
            if ($command instanceof NightlyCommandInterface) {
                $this->taskBag->addTask($command, $command->getPriority());
            }
        }
    }
}
