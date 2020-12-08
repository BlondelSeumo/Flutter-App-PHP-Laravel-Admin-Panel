importScripts('//www.gstatic.com/firebasejs/7.2.0/firebase-app.js');
importScripts('//www.gstatic.com/firebasejs/7.2.0/firebase-messaging.js');

@include('vendor.notifications.init_firebase')

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = payload.data.title;
    const notificationOptions = {
    body: payload.data.body,
    icon: payload.data.icon,
};

return self.registration.showNotification(notificationTitle,notificationOptions);
});
// {{env('APP_NAME')}}
