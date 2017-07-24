<?php

namespace FS\ExposeBundle;

use Expose\FilterCollection;
use Expose\Manager;
use Psr\Log\LoggerInterface;

class ManagerFactory
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return Manager
     */
    public function createDefaultManager() : Manager
    {
        $filter = new FilterCollection();
        $filter->load();

        $manager = new Manager($filter, $this->logger);

        return $manager;
    }
}