<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\Core\Exception;

/**
 * Resolve exception
 *
 * @api
 */
interface ResolveExceptionInterface
{
    /**
     * Execute exception handler
     *
     * @param \Exception $e
     * @param string $namespace
     * @return void
     */
    public function execute(\Exception $e, string $namespace): void;
}
