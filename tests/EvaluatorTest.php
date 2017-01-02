<?php

namespace LisPhp\Tests;

use LisPhp\Environment\StdEnvironment;
use LisPhp\Evaluator;
use LisPhp\Parser;
use PHPUnit_Framework_TestCase;

class EvaluatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getProgramsProvider
     *
     * @param string $program
     * @param mixed  $result
     */
    public function testEvaluate(string $program, $result) : void
    {
        $environment = new StdEnvironment();
        $program = Parser::parse($program);
        $evaluator = new Evaluator($environment);
        $this->assertEquals($result, $evaluator->run($program));
    }

    /**
     * @return array
     */
    public function getProgramsProvider() : array
    {
        return [
            [
                '(+ 10 2 (define a 5) (- a 3))',
                14
            ],
            [
                '(+ 2 (+ 3 4) 9)',
                18,
            ],
            [
                '(if (> (* 11 11) 120) (* 7 6) oops)',
                42,
            ],
            [
                '(quote fede knows lisp)',
                'fede knows lisp',
            ],
            [
                '(if (> 10 9) (quote I won) (quote I lost))',
                'I won',
            ],
        ];
    }
}
