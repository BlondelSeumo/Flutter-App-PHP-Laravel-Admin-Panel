var firebaseConfig = {
  apiKey: "{{setting('firebase_api_key','')}}",
  authDomain: "{{setting('firebase_auth_domain','')}}",
  databaseURL: "{{setting('firebase_database_url','')}}",
  projectId: "{{setting('firebase_project_id','')}}",
  storageBucket: "{{setting('firebase_storage_bucket','')}}",
  messagingSenderId: "{{setting('firebase_messaging_sender_id','')}}",
  appId: "{{setting('firebase_app_id')}}",
  measurementId: "{{setting('firebase_measurement_id','')}}"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);