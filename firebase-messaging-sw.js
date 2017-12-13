importScripts('https://www.gstatic.com/firebasejs/3.6.8/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.6.8/firebase-messaging.js');

var senderId = "970814197197";
firebase.initializeApp({
    messagingSenderId: senderId
});

const messaging = firebase.messaging();