<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\Core\Exception;

use Magento\Framework\Message\ManagerInterface;

/**
 * Resolve exception handler
 *
 * @api
 */
class ResolveException implements ResolveExceptionInterface
{
    /**
     * @var HandlerFactory
     */
    private $handlerFactory;

    /**
     * @var HandlerPoolInterface
     */
    private $handlerPool;

    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * Initialize handler
     *
     * @param HandlerFactory $handlerFactory
     * @param HandlerPoolInterface $handlerPool
     * @param ManagerInterface $messageManager
     * @return void
     */
    public function __construct(
        HandlerFactory $handlerFactory,
        HandlerPoolInterface $handlerPool,
        ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
        $this->handlerFactory = $handlerFactory;
        $this->handlerPool = $handlerPool;
    }

    /**
     * Execute exception handler
     *
     * @param \Exception $e
     * @param string $namespace
     * @return void
     */
    public function execute(\Exception $e, string $namespace): void
    {
        foreach ($this->handlerPool->getHandlers($namespace) as $type => $className) {
            if (is_a($e, $type, true)) {
                $handler = $this->handlerFactory->create($className);
                if (null !== $handler) {
                    $handler->execute($e);
                    return;
                }
            }
        }

        $this->messageManager->addExceptionMessage(
            $e,
            (string)__('An unexpected error occurred. See system log files for details.')
        );
    }
}
