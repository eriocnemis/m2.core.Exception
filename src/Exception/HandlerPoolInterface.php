<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\Core\Exception;

/**
 * Exception handler pool interface
 */
interface HandlerPoolInterface
{
    /**
     * Retrieve handlers list
     *
     * @param string $namespace
     * @return string[]
     */
    public function getHandlers(string $namespace): array;
}
