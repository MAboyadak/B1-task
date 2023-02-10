<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;


class FatoorahService{

    private Client $http;
    private string $baseUrl;
    private array $headers;

    public function __construct(Client $http){
        
        $this->http = $http;
        $this->baseUrl = env('PAYMENT_BASE_URL');
        $this->headers = [
            'Content-Type' => 'application/json',
            'authorization' => 'Bearer ' . env('PAYMENT_TOKEN'),
        ];
        
    }


    public function buildRequest($uri, $method, $body=[]){
        
        $request = new Request($method, $this->baseUrl . $uri, $this->headers);

        // if(!$body){
        //     return false;
        // }

        $response = $this->http->send($request,[
            'json'=> $body,
        ]);


        if($response->getStatusCode() != 200){
            return false;
        }

        $response = json_decode($response->getBody(), true);
        return $response;

    }

    public function sendPayment($data){

        $response = $this->buildRequest('v2/SendPayment', 'POST', $data);
        return $response;

    }



}



?>