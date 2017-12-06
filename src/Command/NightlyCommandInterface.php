<?php

namespace Dekalee\NightlyTaskBundle\Command;

/**
 * Interface NightlyCommandInterface
 */
interface NightlyCommandInterface
{
    /**
     * Higher priority is run first
     *
     * @return int
     */
    public function getPriority();

    /**
     * Returns a boolean if we should only log the failure of the task
     *
     * @return bool
     */
    public function isEssential();
}
