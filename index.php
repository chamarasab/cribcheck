<?php
session_start();
include_once "logic/api.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captcha verification
    $userCaptcha = $_POST['captcha'];

    if (isset($_SESSION["code"]) && $userCaptcha == $_SESSION["code"]) {
        // User validation
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login_url = "http://localhost:8000/login";
        $parameters = array(
            "email" => $email,
            "password" => $password
        );
        $login_response = callAPIPost($login_url, json_encode($parameters));
        //echo $login_response;

        if ($login_response) {
            $response_data = json_decode($login_response, true);
            if (isset($response_data['user'])) {
                showToast("login-success");
            } else {
                showToast("login-failed");
            }
        } else {
            showToast("login-error");
        }
        
    } else {
        showToast("captcha-failed");
    }
} else {
    showToast("welcome");
}

function showToast($message) {
    $_SESSION["message"] = $message;
}

$captcha_url = "logic/captcha.php";
include_once "view/insert.html";
