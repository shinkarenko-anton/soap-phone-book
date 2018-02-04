<?php
try{
    ini_set("soap.wsdl_cache_enabled","0");
	$client = new SoapClient("simple.wsdl");

	$response = array();

	$request = ['name' => 'john', 'email' => '123@qaz.com'];

	$response['helloResponse'] = $client->getHello($request);
	
	$response['goodbyeResponse'] = $client->getGoodbye($request);
	
	print "<pre>";
		print_r($response);
	print "</pre>";
	
} catch(SoapFault $e){
	
	print_r($e);

}
