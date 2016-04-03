<?php

namespace Najki;

use Najki\Exception\NegativesNotAllowedException;

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

        if (!empty($negatives = $this->getNegativeNumbers($numbers))) {
            throw new NegativesNotAllowedException($negatives);
        }

        return array_sum($numbers);
    }

    /**
     * @param string $numbers
     * @return array
     */
    private function splitString($numbers)
    {
        $delimiterPattern = ',|\n';

        if ($this->hasCustomDelimiter($numbers)) {
            $delimiterPattern .= '|'.preg_quote($this->getCustomDelimiter($numbers), '/');
            $numbers = preg_replace('#^//.\n#', '', $numbers);
        }

        return preg_split('/('.$delimiterPattern.')/', $numbers);
    }

    /**
     * @param string $string
     * @return bool
     */
    private function hasCustomDelimiter($string)
    {
        return preg_match('#^//.#', $string);
    }

    /**
     * @param string $string
     * @return string|bool
     */
    private function getCustomDelimiter($string)
    {
        if (preg_match('#^//(.)\n#', $string, $matches)) {
            return $matches[1];
        }

        throw new \InvalidArgumentException();
    }

    /**
     * @param int[] $numbers
     * @return int[]
     */
    private function getNegativeNumbers(array $numbers)
    {
        $negatives = [];

        foreach ($numbers as $number) {
            if ($number < 0) {
                $negatives[] = $number;
            }
        }

        return $negatives;
    }
}
