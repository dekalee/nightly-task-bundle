<?php

namespace Dekalee\NigthlyTaskBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ListNightlyTaskCommand
 */
class ListNightlyTaskCommand extends AbstractNightlyTaskCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('dekalee:nightly:list')
            ->setDescription('List all the command that should run nightly');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->beforeExecute($input, $output);
        $this->fillTasks();

        foreach ($this->getTasks() as $priority => $taskPriority) {
            $output->writeln(sprintf('Priority : <comment>%d</comment>', $priority));
            /** @var Command $task */
            foreach ($taskPriority as $task) {
                $output->writeln(sprintf('%s<info>%s</info>', str_repeat(' ', 10), $task->getName()));
            }
        }
    }
}
