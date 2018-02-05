<?php

spl_autoload_register('autoloader');

function autoloader($class){
    include("$class.php");
}

function server_url(){
    $server ="";

    if(isset($_SERVER['SERVER_NAME'])){
        $server = sprintf("%s://%s%s", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME'], '/');
    }
    else{
        $server = sprintf("%s://%s%s", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_ADDR'], '/');
    }
    return $server;

}

try{
    ini_set("soap.wsdl_cache_enabled","0");
    $options = array(
        "trace"  => true,
        "soap_version" => SOAP_1_2,
        "connection_timeout"    => 30,
        "uri"      => server_url()."server.php",
        'location' => server_url()."server.php"
    );
	$client = new MySoapClient("simple.wsdl", $options);

} catch(SoapFault $e){
	
	print_r($e);

}
