<?php

    function httpPost($url, $data)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    // function LoginPost($url, $jsonData)
    // {
    //     $curl = curl_init($url);
        
    //     // Set the request method to POST
    //     curl_setopt($curl, CURLOPT_POST, true);
        
    //     // Set the request body with JSON data
    //     curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($jsonData));

    //     // Set the Content-Type header to application/json
    //     curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    //     // Receive the response as a string
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
    //     $response = curl_exec($curl);
        
    //     curl_close($curl);
        
    //     return $response;
    // }


    function httpDELETE($url, $data)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE"); // Corrected typo here
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function httpDELPut($url, $data, $method)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
?>