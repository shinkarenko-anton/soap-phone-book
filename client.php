<?php
try{
    ini_set("soap.wsdl_cache_enabled","0");
    $options = array(
        "trace"  => true,
        "soap_version" => SOAP_1_2,
        "connection_timeout"    => 30,
        "uri"      => "http://schemas.xmlsoap.org/wsdl/soap/"
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
