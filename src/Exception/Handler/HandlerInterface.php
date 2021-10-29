<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\Core\Exception\Handler;

/**
 * Exception handler interface
 */
interface HandlerInterface
{
    /**
     * Retrieve the exception message
     *
     * @param \Exception $e
     * @return void
     */
    public function execute(\Exception $e): void;
}
