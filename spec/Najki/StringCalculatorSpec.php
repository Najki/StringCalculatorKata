<?php

namespace spec\Najki;

use Najki\Exception\NegativesNotAllowedException;
use Najki\StringCalculator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author    Nikodem Osmialowski
 * @copyright Codeco
 */
class StringCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StringCalculator::class);
    }

    function it_should_fail_when_non_string_passed()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('add', [null]);
    }

    function it_should_sum_numbers()
    {
        $this->add('')->shouldReturn(0);
        $this->add('1')->shouldReturn(1);
        $this->add('1,2')->shouldReturn(3);
        $this->add('4,5')->shouldReturn(9);
    }

    function it_should_sum_string_with_more_numbers()
    {
        $this->add('1,3,5,6,7')->shouldReturn(22);
    }

    function it_should_sum_string_with_eol_as_delimiter()
    {
        $this->add("1\n2,3")->shouldReturn(6);
    }

    function it_should_sum_string_with_custom_delimiter()
    {
        $this->add("//#\n1#2#")->shouldReturn(3);
    }

    function it_should_sum_string_with_multichar_custom_delimiter()
    {
        $this->add("//[@@]\n2@@3@@4")->shouldReturn(9);
    }

    function it_should_throw_an_exception_when_string_has_negative_numbers()
    {
        $this->shouldThrow(NegativesNotAllowedException::class)->during('add', ['1,-2']);
    }

    function it_should_ignore_large_numbers()
    {
        $this->add('2,1001')->shouldReturn(2);
    }

    function it_should_sum_string_with_multiple_custom_delimiters()
    {
        $this->add("//[%][^]\n1%2^3")->shouldReturn(6);
    }

    function it_should_sum_string_with_multiple_multichar_custom_delimiters()
    {
        $this->add("//[``][@][%][%%]\n1``2%3%%4")->shouldReturn(10);
    }
}
