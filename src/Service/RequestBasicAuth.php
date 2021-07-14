<?php

namespace App\Service;

class RequestBasicAuth extends CustomRequest
{
    /**
     * @param string $url
     * @param mixed $data
     * @param string $requestType
     * @param string $user
     * @param string $password
     */
    public function sendRequest($url, $data = '', $requestType, $user, $password)
    {
        $client = curl_init();
        curl_setopt($client, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($client, CURLOPT_USERPWD, "$user:$password");
        
        return $this->execute($client, $url, $data = '', $requestType);
    }
}