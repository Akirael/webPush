var apiKey = "AIzaSyBrDMKfCzofzhXLlwGiwe9OtQ2_5PsWPJc";
var domain = "test-push-voicecards";
var senderId = "970814197197";

var config = {
    apiKey: apiKey,
    authDomain: domain+".firebaseapp.com",
    databaseURL: "https://"+domain+".firebaseio.com",
    projectId: domain,
    storageBucket: domain+".appspot.com",
    messagingSenderId: senderId
};

$(function() {
    if (!firebase.apps.length) {
        firebase.initializeApp(config);
    }

    if (Notification.permission === 'default') {
        subscribe();
    }

    $('#subscribe').on('click', function () {
        subscribe();
    });
    $('#send').on('click', function () {
        send();
    });

})

function send() {
    var key = 'AIzaSyBrDMKfCzofzhXLlwGiwe9OtQ2_5PsWPJc';
    fetch('https://fcm.googleapis.com/fcm/send', {
        'method': 'POST',
        'headers': {
            'Authorization': 'key=' + key,
            'Content-Type': 'application/json'
        },
        'body': JSON.stringify({
            'notification': {
                "title": "Ералаш",
                "body": "Начало через 15 минут",
                "icon": "https://eralash.ru.rsz.io/sites/all/themes/eralash_v5/logo.png?width=192&height=192",
                "click_action": "http://eralash.ru/"
            },
            "time_to_live": 900,
            'to': 'dmGCipKIoIU:APA91bEWoQzJeL5YCkPKuhki-yVlnqL7fEMoEKGEsiNcbdSCmrldFzCOCMWp1xpXUXTG3sxwULDlLVvNwq-0xFlCLqXfvX3P4Tk5ivOgdJ-WKgx2OaUGUMdsZC4qvrgLQ2OiHvsLkW_T'
        })
    });
}

function subscribe() {
    // запрашиваем разрешение на получение уведомлений
    var messaging = firebase.messaging();

    messaging.requestPermission()
        .then(function () {
            // получаем ID устройства
            messaging.getToken()
                .then(function (currentToken) {
                    console.log(currentToken);

                    if (currentToken) {
                        sendTokenToServer(currentToken);
                    } else {
                        console.warn('Не удалось получить токен.');
                        setTokenSentToServer(false);
                    }
                })
                .catch(function (err) {
                    console.warn('При получении токена произошла ошибка.', err);
                    setTokenSentToServer(false);
                });
        })
        .catch(function (err) {
            console.warn('Не удалось получить разрешение на показ уведомлений.', err);
        });
}

// отправка ID на сервер
function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer(currentToken)) {
        console.log('Отправка токена на сервер...');

        var url = 'http://lwebpush.me/site/save'; // адрес скрипта на сервере который сохраняет ID устройства
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        var message = 'tokken='+currentToken;
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(message);

        setTokenSentToServer(currentToken);
    } else {
        console.log('Токен уже отправлен на сервер.');
    }
}

function isTokenSentToServer(currentToken) {
    return window.localStorage.getItem('sentFirebaseMessagingToken') == currentToken;
}

function setTokenSentToServer(currentToken) {
    window.localStorage.setItem(
        'sentFirebaseMessagingToken',
        currentToken ? currentToken : ''
    );
}

function getToken() {
    return window.localStorage.getItem('sentFirebaseMessagingToken');
}