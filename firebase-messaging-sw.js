// firebase-messaging-sw.js
importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js');


firebase.initializeApp({
    apiKey: "AIzaSyAbfBhGif9jZMknXq0VgmlCpNyJQxEndAU",
    authDomain: "my-project-1571431207759.firebaseapp.com",
    databaseURL: "https://my-project-1571431207759-default-rtdb.firebaseio.com",
    projectId: "my-project-1571431207759",
    storageBucket: "my-project-1571431207759.firebasestorage.app",
    messagingSenderId: "766106166614",
    appId: "1:766106166614:web:5f6508543f7bba15c522f7"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: payload.notification.icon
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
