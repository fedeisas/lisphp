<?php

namespace LisPhp;

class Evaluator
{
    protected $environment;

    public function __construct($environment)
    {
        $this->environment = $environment;
    }

    public function run($program)
    {
        if (is_string($program) && isset($this->environment[$program])) {
            return $this->environment[$program];
        } elseif (is_string($program) || is_numeric($program) || !is_array($program)) {
            return $program;
        } elseif ($program[0] == 'if') {
            list(, $test, $consequence, $alternative) = $program;
            $expression = ($this->run($test) ? $consequence : $alternative);

            return $this->run($expression);
        } else {
            $function = $this->environment[$program[0]];

            $arguments = array_map(function ($value) {
                return $this->run($value);
            }, array_slice($program, 1));

            return $function($arguments);
        }
    }
}
