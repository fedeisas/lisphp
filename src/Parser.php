<?php

namespace LisPhp;

use RuntimeException;

class Parser
{
    /**
     * @param string $input
     *
     * @return array
     */
    public static function parse(string $input) : array
    {
        $input = static::cleanup($input);

        $tokens = static::tokenize($input);

        return static::readFromTokens($tokens);
    }

    /**
     * @param array $tokens
     *
     * @return array
     */
    private static function readFromTokens(array &$tokens)
    {
        if (count($tokens) === 0) {
            throw new RuntimeException('Unexpected EOF while reading');
        }

        $token = array_shift($tokens);

        if ($token === '(') {
            $list = [];

            while (count($tokens) && $tokens[0] !== ')') {
                $list[] = static::readFromTokens($tokens);
            }

            if (count($tokens) && $tokens[0] === ')') {
                array_shift($tokens);
            } else {
                throw new RuntimeException('Invalid syntax');
            }

            return $list;
        } elseif ($token === ')') {
            throw new RuntimeException('Invalid syntax');
        } else {
            return static::atom($token);
        }
    }

    /**
     * Splits a program into tokens.
     *
     * @param string $input
     *
     * @return array $tokens
     */
    private static function tokenize(string $input) : array
    {
        $tokens = array_filter(
            explode(
                ' ',
                str_replace(['(', ')'], [' ( ', ' ) '], $input)
            ),
            function ($value) {
                return $value !== '';
            }
        );

        return $tokens;
    }

    /**
     * Converts a token into an atom.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    private static function atom($value)
    {
        if (is_numeric($value)) {
            return is_float($value) ? (float) $value : (int) $value;
        } else {
            return $value;
        }
    }

    /**
     * Cleanups extra spaces.
     *
     * @param string $input
     *
     * @return string $input
     */
    private static function cleanup($input)
    {
        $input = preg_replace('/\s+/', ' ', $input);
        $input = preg_replace('/\(\s+/', ' (', $input);
        $input = preg_replace('/\s+\(/', ' (', $input);
        $input = preg_replace('/\s+\)/', ') ', $input);
        $input = preg_replace('/\)\s+/', ') ', $input);
        $input = trim($input);

        return $input;
    }
}
