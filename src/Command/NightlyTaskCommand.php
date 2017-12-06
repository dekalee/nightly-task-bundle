<?php

namespace Dekalee\NightlyTaskBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class NightlyTaskCommand
 */
class NightlyTaskCommand extends AbstractNightlyTaskCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('dekalee:nightly:tasks')
            ->setDescription('Launch all the command that should run nightly');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->beforeExecute($input, $output);
        $this->fillTasks();

        foreach ($this->getTasks() as $priority => $taskPriority) {
            /** @var Command $task */
            foreach ($taskPriority as $task) {
                try {
                    $this->runCommand($task->getName());
                } catch (\Exception $e) {
                    if ($task instanceof NightlyCommandInterface && $task->isEssential()) {
                        throw $e;
                    }
                    $this->logger->error('Error during non essential nightly task', [
                        'command name' => $task->getName(),
                        'exception message' => $e->getMessage(),
                        'exception class' => get_class($e),
                    ]);
                }
            }
        }
    }

    /**
     * Run command.
     *
     * @param string $commandName
     * @param array  $arguments
     *
     * @throws \Exception
     */
    protected function runCommand($commandName, array $arguments = [])
    {
        $arguments['command'] = $commandName;
        $arguments['--env'] = $this->input->getOption('env');

        $input = new ArrayInput($arguments);
        $input->setInteractive(false);
        $command = $this->getApplication()->find($commandName);
        $command->run($input, $this->output);
    }
}
