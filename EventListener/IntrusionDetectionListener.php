<?php

namespace FS\ExposeBundle\EventListener;

use Expose\Manager;
use FS\ExposeBundle\Handler\IntrusionHandlerInterface;
use FS\ExposeBundle\IntrusionException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class IntrusionDetectionListener
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * @var IntrusionHandlerInterface[]
     */
    private $handlerConfigs;

    /**
     * @var int
     */
    private $threshold;

    /**
     * @param Manager $manager
     * @param int     $threshold
     */
    public function __construct(Manager $manager, int $threshold)
    {
        $this->manager = $manager;
        $this->threshold = $threshold;
    }

    /**
     * @param IntrusionHandlerInterface $intrusionHandler
     */
    public function addHandler(IntrusionHandlerInterface $intrusionHandler)
    {
        $this->handlerConfigs[] = $intrusionHandler;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();
        $data = [
            'GET' => $request->query->all(),
            'POST' => $request->request->all()
        ];

        $this->manager->run($data);

        if ($this->manager->getImpact() == 0) {
            return;
        }

        foreach ($this->handlerConfigs as $handler) {
            $handler->handleIntrusion($this->manager->getImpact(), $this->manager->getReports());
        }

        if ($this->threshold === 0) {
            return;
        }

        if ($this->manager->getImpact() >= $this->threshold) {
            throw new IntrusionException();
        }
    }
}