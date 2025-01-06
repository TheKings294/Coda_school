<?php
require '.env';
function prepare_url($baseUrl, $userId) {
    $secretKey = getenv('SECRET_KEY');
    $expiration = time() + 600;

    // Créer un token avec les informations
    $data = "$userId|$expiration";
    $signature = hash_hmac('sha256', $data, $secretKey);
    $token = base64_encode("$data|$signature");

    return "$baseUrl&token=$token";
}
function send_mail($url, $mail, $subject, $body)
{
    $res = mail($mail, $subject, $body);

    return $res ? true : false;
}