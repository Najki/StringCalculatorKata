<?php

namespace Najki\Exception;

/**
 * @author    Nikodem Osmialowski
 * @copyright Codeco
 */
class NegativesNotAllowedException extends \InvalidArgumentException
{
    public function __construct(array $negatives)
    {
        parent::__construct('Negatives not allowed: ' . implode(', ', $negatives));
    }
}
