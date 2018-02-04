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
$options = array(
    "trace"  => true,
    "soap_version" => SOAP_1_2,
    "connection_timeout"    => 30,
    "uri"      => "http://schemas.xmlsoap.org/wsdl/soap/"
);
$server = new SoapServer("simple.wsdl", $options);

$server->setClass('Storage');

$server->handle();
