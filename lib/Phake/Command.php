<?php
/**
 * @author David Rogers <david@orlandophp.org>
 * @author Ketema Harris <ketema@ketema.net>
 *
 * @package Phake
 * @subpackage Command  (WHY NOT CALL IT ARGUMENT PARSER ?)
 * @category Argument_Parsing
 */

// PHP 5.3 namespace
namespace Phake;

class Command //Why is this a command rather than an argument parser ?
{
    function usage ( )
    {
        return 'usage: command';
    }

    function addArgument ( ) { }
} // END class
