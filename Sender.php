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
$YOUR_API_KEY = 'AAAA4gkJDc0:APA91bGIVFzl2GRSPY7AgmvLL_2NVxNUGlX0d0MQWAyJ-_Ine6ZpKw7AEKMYTQNrLGuLF0-mTOaAART1MU5twHvTYV67FcEf2tAflDnQs4C--5SVrLkhXIQ61bWfFdnj0nVHMzFGJz_K';
$YOUR_TOKEN_ID = array(
    'eq58lZK7tHI:APA91bFAPprFr3WX_MsIel5yReEJf3fncPQdKG8lWlyOPybCRcrwiZmMso6ntXzVRcooUhKiQb13TS-Ejj6AruJnLTwUv-20OjUNPzJaH4tnHFo3jybsuasUhoaZ6g6XZvjkYtUysgJU',
    'dmGCipKIoIU:APA91bEWoQzJeL5YCkPKuhki-yVlnqL7fEMoEKGEsiNcbdSCmrldFzCOCMWp1xpXUXTG3sxwULDlLVvNwq-0xFlCLqXfvX3P4Tk5ivOgdJ-WKgx2OaUGUMdsZC4qvrgLQ2OiHvsLkW_T'
    );

//
//$YOUR_TOKEN_ID = json_encode($YOUR_TOKEN_ID);
$request_body = [
    'registration_ids' => $YOUR_TOKEN_ID,
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