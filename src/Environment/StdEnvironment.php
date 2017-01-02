<?php

namespace LisPhp\Environment;

class StdEnvironment extends Environment
{
    public function __construct()
    {
        $this->container += [
            '+' => function() {
                return array_sum(func_get_arg(0));
            },
            '-' => function() {
                list($first, $second) = func_get_arg(0); // array [5, 3]
                return $first - $second;
            },
            '*' => function() {
                return array_product(func_get_arg(0));
            },
            '/' => function() {
                return func_get_arg(0)[0] / func_get_arg(0)[1];
            },
            '>' => function() {
                return func_get_arg(0)[0] > func_get_arg(0)[1];
            },
            '>=' => function() {
                return func_get_arg(0)[0] >= func_get_arg(0)[1];
            },
            '<' => function() {
                return func_get_arg(0)[0] < func_get_arg(0)[1];
            },
            '<=' => function() {
                return func_get_arg(0)[0] <= func_get_arg(0)[1];
            },
            '=' => function() {
                return func_get_arg(0)[0] == func_get_arg(0)[1];
            },
            'abs' => function() {
                return abs(func_get_arg(0));
            },
            'not' => function() {
                return !func_get_arg(0);
            },
            'first' => function() {
                return func_get_arg(0)[0][0];
            },
            'list' => function() {
                return func_get_args()[0];
            },
            'eq?' => function() {
                return func_get_arg(0)[0] == func_get_arg(0)[1];
            },
            'number?' => function() {
                return is_numeric(func_get_arg(0));
            },
            'quote' => function() {
                return implode(' ', func_get_arg(0));
            },
            'define' => function() {
                list($name, $value) = func_get_arg(0);
                $this[$name] = $value;
            },
        ];
    }
}
