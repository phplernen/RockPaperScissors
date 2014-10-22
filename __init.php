<?php

set_include_path( implode( PATH_SEPARATOR, array(
	realpath( __DIR__ . '/../' ),
	get_include_path(),
) ) );

spl_autoload_register( function($className)
{
	$fileName = str_replace( '\\', '/', $className ) . '.php';
	require_once $fileName;
} );