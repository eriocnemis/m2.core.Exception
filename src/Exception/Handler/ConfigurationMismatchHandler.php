<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\Core\Exception\Handler;

use Psr\Log\LoggerInterface;
use Magento\Framework\Message\ManagerInterface;

/**
 * Configuration mismatch exception handler
 */
class ConfigurationMismatchHandler implements HandlerInterface
{
    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Initialize handler
     *
     * @param ManagerInterface $messageManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        ManagerInterface $messageManager,
        LoggerInterface $logger
    ) {
        $this->messageManager = $messageManager;
        $this->logger = $logger;
    }

    /**
     * Retrieve the exception message
     *
     * @param \Exception $e
     * @return void
     */
    public function execute(\Exception $e): void
    {
        $message = __(
            'Configuration mismatch detected. See system log files for details.'
        );

        $this->messageManager->addErrorMessage((string)$message);
        $this->logger->critical($e->getMessage(), ['exception' => $e]);
    }
}
