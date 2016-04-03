<?php

namespace Najki;

/**
 * @author    Nikodem Osmialowski
 * @copyright Codeco
 */
class StringCalculator
{
    /**
     * @param string $numbers
     * @return int
     * @throws \InvalidArgumentException
     */
    public function add($numbers)
    {
        if (!is_string($numbers)) {
            throw new \InvalidArgumentException();
        }

        $numbers = $this->splitString($numbers);

        return array_sum($numbers);
    }

    private function splitString($numbers)
    {
        return $numbers = explode(',', $numbers);
    }
}
