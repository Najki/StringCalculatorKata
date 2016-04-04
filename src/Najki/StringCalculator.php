<?php

namespace Najki;

use Najki\Exception\NegativesNotAllowedException;

/**
 * @author    Nikodem Osmialowski
 * @copyright Codeco
 */
class StringCalculator
{
    const MAX_NUMBER = 1000;

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

        $numbers = $this->filterNumbers($numbers);

        return array_sum($numbers);
    }

    /**
     * @param string $numbers
     * @return array
     */
    private function splitString($numbers)
    {
        $delimiterPattern = ',|\n';
        $customDelimiter = $this->getCustomDelimiter($numbers);

        if ($customDelimiter) {
            $delimiterPattern .= '|'.preg_quote($customDelimiter, '/');
            $numbers = preg_replace('#^//.\n#', '', $numbers);
        }

        return preg_split('/('.$delimiterPattern.')/', $numbers);
    }

    /**
     * @param string $string
     * @return string|null
     */
    private function getCustomDelimiter($string)
    {
        if (preg_match('#^//\[(.+)\]\n#', $string, $matches)) {
            return $matches[1];
        }

        if (preg_match('#^//(.)\n#', $string, $matches)) {
            return $matches[1];
        }

        return null;
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

    /**
     * @param int[] $numbers
     * @return int[]
     */
    private function filterNumbers(array $numbers)
    {
        return array_filter($numbers, function ($value) {
            return $value <= self::MAX_NUMBER;
        });
    }
}
