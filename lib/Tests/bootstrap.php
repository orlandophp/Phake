<?php
/**
 * @author David Rogers <david@orlandophp.org>
 * @author Ketema Harris <ketema@ketema.net>
 * @package tests
 * @name bootstrap
 */

/**
 * The production code is in the parent directory, so we need to add
 * that path to the include path.
 */
set_include_path(join(PATH_SEPARATOR, array(
    realpath(dirname(dirname(__FIlE__))),
    get_include_path(),
)));

/**
 * Simple autoloader for translating namespaces and underscores into
 * filesystem paths.
 */
spl_autoload_register(function( $classname ){
    require str_replace(array('\\', '_'), '/', $classname) . '.php';
});
