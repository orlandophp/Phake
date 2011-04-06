Phake is:
========

An argument parser for writing CLI commands:
--------------------------------------------

    >>> less example.php
    #!/usr/bin/env php
    <?php
    require_once 'Phake/Command.php';

    $command = new Phake\Command('An optional description');
    $command->addArgument('--verbose', 'Be awfully chatty');

    extract($command());

    if ( $verbose )
        echo "Well, aren't we chatty?";

    >>> ./example.php --verbose
    Well, aren't we chatty?
    >>> ./example.php something_bad
    Unexpected argument: "something_bad"
    usage: ./example.php [--verbose]

        An optional description.

        --verbose   Be awfully chatty


A framework for writing extensible CLI commands:
------------------------------------------------

    >>> less example.php
    <?php
    class Example extends \Phake\Command
    {
        function arguments ( )
        {
            return array(
                array('--verbose', 'type' => self::CONST, 
                    'default' => false, 'value' => true,
                    'help' => 'Gift of gab',
                ),
            );
        }

        function command ( $args )
        {
            if ( $args['verbose'] )
                echo "Now isn't this handy?";
        }
    }
    >>> phake example --verbose
    Now isn't this handy?
    >>> phake example --help
    usage: phake example [--verbose]

        --verbose   Gift of gab


