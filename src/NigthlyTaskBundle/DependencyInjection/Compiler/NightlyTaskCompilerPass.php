<?php

namespace Dekalee\NigthlyTaskBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class NightlyTaskCompilerPass
 */
class NightlyTaskCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $manager = $container->getDefinition('dekalee_nigthly_task.bag.task');
        $strategies = $container->findTaggedServiceIds('dekalee_nightly.task.strategy');
        foreach ($strategies as $id => $strategy) {
            $strategy[0] = array_merge([
                'priority' => 0,
            ], $strategy[0]);
            $manager->addMethodCall('addTask', [new Reference($id), $strategy[0]['priority']]);
        }
    }
}
