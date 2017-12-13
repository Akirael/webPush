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




// браузер поддерживает уведомления
// вообще, эту проверку должна делать библиотека Firebase, но она этого не делает
$(function() {
    if (!firebase.apps.length) {
        firebase.initializeApp(config);
    }

    console.info(Notification.permission);

    if (Notification.permission === 'default') {
        subscribe();
    }

    $('#subscribe').on('click', function () {
        subscribe();
    });

})

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

        var url = ''; // адрес скрипта на сервере который сохраняет ID устройства
        $.post(url, {
            token: currentToken
        });

        setTokenSentToServer(currentToken);
    } else {
        console.log('Токен уже отправлен на сервер.');
    }
}

// используем localStorage для отметки того,
// что пользователь уже подписался на уведомления
function isTokenSentToServer(currentToken) {
    return window.localStorage.getItem('sentFirebaseMessagingToken') == currentToken;
}

function setTokenSentToServer(currentToken) {
    window.localStorage.setItem(
        'sentFirebaseMessagingToken',
        currentToken ? currentToken : ''
    );
}