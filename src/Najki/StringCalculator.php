<?php

namespace Najki;

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

        $numbers = explode(',', $numbers);

        return array_sum($numbers);
    }
}
