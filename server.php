<?php

/**
 * SOAP SERVER
 * 
 * @file
 * Provides a simple SOAP server for test
 */

spl_autoload_register('autoloader');

function autoloader($class){
    include("$class.php");
}

// don't cache WSDL file
ini_set("soap.wsdl_cache_enabled","0");

$server = new SoapServer("simple.wsdl");

$server->setClass('Storage');

$server->handle();
