var firebaseConfig = {
    apiKey: "AIzaSyCh-Lso9ycdPnpdLqza59XnPuElEnX6__g",
    authDomain: "appthoviet.firebaseapp.com",
    databaseURL: "https://appthoviet-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "appthoviet",
    storageBucket: "appthoviet.appspot.com",
    messagingSenderId: "886027498015",
    appId: "1:886027498015:web:2e0921da1be0b7be8a5b2a",
    measurementId: "G-V9GR6L2D0E"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
//firebase.analytics();
// const messaging = firebase.messaging();
const messaging = firebase.messaging.isSupported() ? firebase.messaging() : null;
messaging
    .requestPermission()
    .then(function() {
        //MsgElem.innerHTML = "Notification permission granted."
        console.log("Notification permission granted....");

        // get the token in the form of promise
        return messaging.getToken()
    })
    .then(function(token) {
        // print the token on the HTML page
        console.log(token);
    })
    .catch(function(err) {
        console.log("Unable to get permission to notify.", err);
    });

messaging.onMessage(function(payload) {
    console.log(payload);
    var notify;
    notify = new Notification(payload.notification.title, {
        body: payload.notification.body,
        icon: payload.notification.icon,
        tag: "Dummy"
    });
    console.log(payload.notification);
});