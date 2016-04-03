<?php

namespace spec\Najki;

use Najki\StringCalculator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StringCalculator::class);
    }

    function it_should_sum_numbers()
    {
        $this->add('')->shouldReturn(0);
        $this->add('1')->shouldReturn(1);
        $this->add('1,2')->shouldReturn(3);
        $this->add('4,5')->shouldReturn(9);
    }
}
