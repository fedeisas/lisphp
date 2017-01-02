<?php

namespace LisPhp\Tests;

use LisPhp\Environment\StdEnvironment;
use PHPUnit_Framework_TestCase;

class StandardEnvironmentTest extends PHPUnit_Framework_TestCase
{
    public function testSetVariable()
    {
        $environment = new StdEnvironment();
        $environment['foo'] = 'bar';
        $this->assertEquals('bar', $environment['foo']);
    }

    public function testSetVariableTwice()
    {
        $environment = new StdEnvironment();
        $environment['foo'] = 'bar';
        $environment['foo'] = 'bar';
    }

    public function testFunctionMath()
    {
        $environment = new StdEnvironment();
        $this->assertEquals(6, $environment['+']([1, 2, 3]));
        $this->assertEquals(6, $environment['-']([18, 12]));
        $this->assertEquals(16, $environment['*']([4, 4]));
        $this->assertEquals(5, $environment['/']([10, 2]));
        $this->assertEquals(true, $environment['>']([10, 2]));
        $this->assertEquals(false, $environment['>']([2, 10]));
        $this->assertEquals(false, $environment['<']([10, 2]));
        $this->assertEquals(true, $environment['<']([2, 10]));
    }
}
