<?php

namespace LisPhp\Tests;

use LisPhp\Parser;
use PHPUnit_Framework_TestCase;
use RuntimeException;

class ParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param string $input
     * @param array  $expected
     * @dataProvider getGoodParseCases
     */
    public function testParse(string $input, array $expected) : void
    {
        $this->assertEquals($expected, Parser::parse($input));
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Invalid syntax
     *
     * @param string $input
     * @dataProvider getBadParseCases
     */
    public function testParseBadProgram(string $input) : void
    {
        Parser::parse($input);
    }

    /**
     * @return array
     */
    public function getGoodParseCases() : array
    {
        return [
            [
                '(foo (+ 1 2))',
                [
                    'foo',
                    ['+', 1, 2],
                ],
            ],
            [
                '(begin (define r 10) (* pi (* r r)))',
                [
                    'begin',
                    ['define', 'r', 10],
                    ['*', 'pi', ['*', 'r', 'r']],
                ],
            ],
            [
                '(first (list 1 (+ 2 3) 9))',
                [
                    'first',
                    ['list', 1, ['+', 2, 3], 9],
                ],
            ],
            [
                '(foo ( define 1)
                (bar zas))',
                ['foo', ['define', 1], ['bar', 'zas']],
            ],
            [
                '(foo bar   zas ( 1 8 3))',
                ['foo', 'bar', 'zas', [1, 8, 3]],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getBadParseCases() : array
    {
        return [
            ['(+ 1 2'],
            ['((+ 1 2'],
            ['(()'],
            ['))'],
        ];
    }
}
