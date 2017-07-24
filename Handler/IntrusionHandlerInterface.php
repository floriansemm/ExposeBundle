<?php

namespace FS\ExposeBundle\Handler;

use Expose\Report;

interface IntrusionHandlerInterface
{
    /**
     * @param int      $impact
     * @param Report[] $reports
     */
    public function handleIntrusion(int $impact, array $reports);
}