<?php

namespace App\Service;

abstract class CustomRequest
{
    protected function execute($client, $url, $data = '', $requestType)
    {
        curl_setopt($client, CURLOPT_URL, $url);
        curl_setopt($client, CURLOPT_CUSTOMREQUEST, $requestType);
        curl_setopt($client, CURLOPT_POSTFIELDS, $data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($client, CURLOPT_FAILONERROR, true);
 
        $response = curl_exec($client);
        $error = curl_error($client);
        $errorNumber = curl_errno($client);
 
        curl_close($client);
 
        if (0 !== $errorNumber) {
            throw new \RuntimeException($error, $errorNumber);
        }
 
        return json_decode($response);
    }
}