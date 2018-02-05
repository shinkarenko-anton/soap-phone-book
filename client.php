<?php

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
	$client = new SoapClient("simple.wsdl", $options);

	$response = [];

	$request = [
	    'name' => 'john',
        'email' => '123@qaz.com',
        'phone' => '12345',
        'address' => 'ffddee 123',
        ];

	//$response['helloResponse'] = $client->getHello($request);
	
	//$response['goodbyeResponse'] = $client->getGoodbye($request);
    //$response['all'] = $client->getAll();
    //$response['insert'] = $client->insertData($request);


	
	/*print "<pre>";
		print_r($response);
	print "</pre>";
	*/
} catch(SoapFault $e){
	
	print_r($e);

}
