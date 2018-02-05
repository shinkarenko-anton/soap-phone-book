<?php

class MySoapClient extends SoapClient
{
    public function __doRequest ($request, $location, $action, $version, $one_way = 0) {
        $response = parent::__doRequest ($request, $location, $action, $version, $one_way);
        $fd = fopen("log.txt", 'a') or die("error opening file");
        $str = $request . PHP_EOL . $response . PHP_EOL;
        fwrite($fd, $str);
        fclose($fd);

        return $response;
    }

}