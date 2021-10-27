<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\Core\Exception;

use Psr\Log\LoggerInterface;
use Magento\Framework\ObjectManagerInterface;
use Eriocnemis\Core\Exception\Handler\HandlerInterface;

/**
 * Exception handler factory
 */
class HandlerFactory
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Initialize factory
     *
     * @param ObjectManagerInterface $objectManager
     * @param LoggerInterface $logger
     * @return void
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        LoggerInterface $logger
    ) {
        $this->objectManager = $objectManager;
        $this->logger = $logger;
    }

    /**
     * Create handler
     *
     * @param string $className
     * @return HandlerInterface|null
     */
    public function create(string $className)
    {
        if (!class_exists($className)) {
            $this->logger->critical(
                (string)__('Type "%1" is not exists', $className)
            );
            return null;
        }

        $handler = $this->objectManager->create($className);
        if (!$handler instanceof HandlerInterface) {
            $this->logger->critical(
                (string)__('Type "%1" is not instance on %2', $className, HandlerInterface::class)
            );
            return null;
        }
        return $handler;
    }
}
