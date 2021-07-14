<?php

namespace App\Service;

class RequestTokenAuth extends CustomRequest
{
    /**
     * @param string $url
     * @param mixed $data
     * @param string $requestType
     * @param string $token
     */
    public function sendRequest($url, $data = '', $requestType, $token)
    {
        $client = curl_init();
        curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $token ));
        
        return $this->execute($client, $url, $data = '', $requestType);
    }
}