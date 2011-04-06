<?php

namespace Phake;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function setUp ( )
    {
        $this->fixture = new Command;
    }//END Setup


    function test_usage ( $command = 'command', $options = array(), $arguments = array() )
    {
        $options = join('', $options);

        if ( $options ) $options = "[-{$options}] ";

        $arguments = join(' ', $arguments);

        $this->assertEquals($this->fixture->usage(),
            'usage: ' . join(' ', array(
                $command, $options, $arguments
            ))
        );
    }

    public function test_addArgument ( )
    {
        $this->assertTrue(method_exists($this->fixture, 'addArgument'),
            'The $fixture should have the "addArgument" method.'
        );

        $this->fixture->addArgument('something');

        $this->test_usage(array(), array('something'));
    }
} // END CommandTest
