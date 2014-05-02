Phake is:
========

An argument parser for writing CLI commands:
--------------------------------------------

Use `Phake\Command` to instantiate a new argument parser object that can be imperatively defined. Invoke the resulting `$command` as a callable to parse arguments from a string, an array of words or just `$ARGV` by default.

### `command.php`

```php
#!/usr/bin/env php
<?php

$command = new Phake\Command('An optional description');
$command->addArgument('--verbose', 'Be awfully chatty');

// Invoke $command to get $arguments as a hash...
$arguments = $command(); // Without $args, `Phake\Command` uses $ARGV...

extract($command()); // Use extract() to get hash keys as local variables...

if ( $verbose ){ // $verbose == $arguments['verbose'] >> '--verbose'
    echo "Well, aren't we chatty?";
}
```

```bash
>>> ./command.php --verbose
Well, aren't we chatty?

>>> ./command.php something_bad
ERROR: Unexpected argument: "something_bad"

>>> ./command.php --help
usage: ./example.php [--verbose]

    An optional description.

    --verbose   Be awfully chatty
```

A framework for writing extensible CLI commands:
------------------------------------------------

Extend `Phake\Command` to write extensible command line utilities that understand arguments and can be invoked with the `phake` command. You may need a `Phakefile` for this usage to tell `phake` where your command extensions live. But it will try to do something intelligent by default.

### `Example.php`

```php
<?php
class Example extends \Phake\Command
{
    function arguments ( )
    {
        return [
            ['--verbose', 'type' => self::TYPE_CONST, 
                'default' => false, 'value' => true,
                'help' => 'Gift of gab',
            ],
        ];
    }

    function command ( $args )
    {
        extract($args);
        
        if ( $verbose or $args['verbose'] )
            echo "Now isn't this handy?";
    }
}
```

```bash
>>> phake example --verbose
Now isn't this handy?

>>> phake example --help
usage: phake example [--verbose]

    --verbose   Gift of gab
```

Extending our `Example`, we can add more arguments to the parser without a lot of inheritance trickery:

### `AnotherExample.php`

```php
<?php

class AnotherExample extends Example
{
    function arguments ( ) {
        return [
            [ '--quiet',  'type' => self::TYPE_CONST,
                'default' => false, 'value' => true,
                'help' => 'Shaddap already!',
            ]
        ]);
    }
}
```

Now `AnotherExample` has the the `Example` arguments as well as its own:

```bash
>>> phake anotherExample --help
usave: phake anotherExample [--verbose] [--quiet]

    --verbose   Gift of gab
    
    --quiet     Shaddap already!
```

If this violates the "Principle of Least Surprise" for you, you're probably looking for something other than inheritance. `Phake\Command` subclasses play nice with PHP Traits, so try those instead.
