<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\Core\Exception;

/**
 * Exception handler pool
 */
class HandlerPool implements HandlerPoolInterface
{
    /**
     * @var mixed[]
     */
    private $handlers;

    /**
     * Initialize pool
     *
     * @param mixed[] $handlers
     */
    public function __construct(
        array $handlers = []
    ) {
        $this->handlers = $handlers;
    }

    /**
     * Retrieve handlers list
     *
     * @param string $namespace
     * @return string[]
     */
    public function getHandlers(string $namespace): array
    {
        $handlers = [];
        foreach ($this->sort($this->handlers) as $name => $data) {
            if ($this->validate($data) && in_array($namespace, $data['namespace'])) {
                $handlers[$name] = $data['class'];
            }
        }
        return $handlers;
    }

    /**
     * Validate handler data
     *
     * @param mixed[] $data
     * @return bool
     */
    private function validate(array $data): bool
    {
        foreach (['class', 'sortOrder', 'namespace'] as $argument) {
            if (empty($data[$argument])) {
                return false;
            }
        }
        return true;
    }

    /**
     * Sorting handlers according to sort order
     *
     * @param mixed[] $data
     * @return mixed[]
     */
    private function sort(array $data)
    {
        uasort($data, function (array $a, array $b) {
            return $this->getSortOrder($a) <=> $this->getSortOrder($b);
        });

        return $data;
    }

    /**
     * Retrieve sort order from array
     *
     * @param mixed[] $variable
     * @return int
     */
    private function getSortOrder(array $variable)
    {
        return !empty($variable['sortOrder']) ? $variable['sortOrder'] : 0;
    }
}
