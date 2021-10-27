<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\Core\Exception\Handler;

use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Exception\AggregateExceptionInterface;

/**
 * Validation exception handler
 */
class ValidationHandler implements HandlerInterface
{
    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * Initialize handler
     *
     * @param ManagerInterface $messageManager
     * @return void
     */
    public function __construct(
        ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
    }

    /**
     * Retrieve the exception message
     *
     * @param \Exception $e
     * @return void
     */
    public function execute(\Exception $e): void
    {
        if ($e instanceof AggregateExceptionInterface) {
            foreach ($e->getErrors() as $error) {
                $this->messageManager->addErrorMessage($error->getMessage());
            }
        }
    }
}
