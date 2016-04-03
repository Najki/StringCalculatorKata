<?php

namespace Najki;

class StringCalculator
{
    /**
     * @param string $numbers
     * @return int
     */
    public function add($numbers)
    {
        $numbers = explode(',', $numbers);

        return array_sum($numbers);
    }
}
