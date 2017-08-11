<?php

namespace FS\ExposeBundle\Handler;

use Expose\Report;
use Symfony\Component\HttpFoundation\Request;

interface IntrusionHandlerInterface
{
    /**
     * @param Request  $request
     * @param int      $impact
     * @param Report[] $reports
     */
    public function handleIntrusion(Request $request, int $impact, array $reports);
}