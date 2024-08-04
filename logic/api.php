<?php

function callAPIGet($url)
{
    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
    ));

    // Execute cURL request
    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        $error_message = curl_error($curl);
        // Handle cURL errors
        return json_encode(array('success' => false, 'message' => "Error occurred: " . $error_message));
    }

    // Close cURL session
    curl_close($curl);

    return $response;
}

function callAPIPost($url, $jsonData) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        )
    ));
    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        $error_message = curl_error($curl);
        return json_encode(array('success' => false, 'message' => "Error occurred: " . $error_message));
    }
    curl_close($curl);
    return $response;
}

