<?php
/**
 * Created by PhpStorm.
 * User: borisov
 * Date: 13.12.17
 * Time: 16:13
 */
?>

<?php

$url = 'https://fcm.googleapis.com/fcm/send';
$YOUR_API_KEY = 'AIzaSyBrDMKfCzofzhXLlwGiwe9OtQ2_5PsWPJc';
//$YOUR_TOKEN_ID = $argv[1];
$YOUR_TOKEN_ID = 'dmGCipKIoIU:APA91bEWoQzJeL5YCkPKuhki-yVlnqL7fEMoEKGEsiNcbdSCmrldFzCOCMWp1xpXUXTG3sxwULDlLVvNwq-0xFlCLqXfvX3P4Tk5ivOgdJ-WKgx2OaUGUMdsZC4qvrgLQ2OiHvsLkW_T';


$request_body = [
    'to' => $YOUR_TOKEN_ID,
    'notification' => [
        'title' => 'Ералаш',
        'body' => sprintf('Начало в %s.', date('H:i')),
        'icon' => 'https://eralash.ru.rsz.io/sites/all/themes/eralash_v5/logo.png?width=192&height=192',
        'click_action' => 'http://eralash.ru/',
    ],
];
$fields = json_encode($request_body);

$request_headers = [
    'Content-Type: application/json',
    'Authorization: key=' . $YOUR_API_KEY,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>