<?php

namespace Dekalee\NightlyTaskBundle;

use Dekalee\NightlyTaskBundle\DependencyInjection\Compiler\NightlyTaskCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class DekaleeNightlyTaskBundle
 */
class DekaleeNightlyTaskBundle extends Bundle
{
    /**
     * Builds the bundle.
     *
     * It is only ever called once when the cache is empty.
     *
     * This method can be overridden to register compilation passes,
     * other extensions, ...
     *
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new NightlyTaskCompilerPass());
    }
}
