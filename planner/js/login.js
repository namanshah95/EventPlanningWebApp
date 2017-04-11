$( document ).ready( login_initialize );

function login_initialize()
{
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyBTRyc3-cHmmzduDU4uW0mBUp5-HSMhOZs",
      authDomain: "http://event-planner-160406.firebaseapp.com/",
      databaseURL: "https://event-planner-160406.firebaseio.com/",
      projectId: "event-planner-160406",
      storageBucket: "event-planner-160406.appspot.com",
      messagingSenderId: "713872703785",
    };

    firebase.initializeApp( config );

    firebase.auth().onAuthStateChanged( function( user ) {
        if( user )
        {
            var displayName   = user.displayName;
            var email         = user.email;
            var emailVerified = user.emailVerified;
            var photoURL      = user.photoURL;
            var isAnonymous   = user.isAnonymous;
            var uid           = user.uid;
            var providerData  = user.providerData;

            var login_url = '/common/php/ajax/login.php';
            var login_data = { 'ext_firebase_id' : uid };

            $.post( login_url, login_data, function( response, textStatus, jqXHR ) {
                window.location = '/planner/index.php';
            });
        }
    });

    $( '#login_form' ).submit( login );
}

function login( event )
{
    event.preventDefault();

    var email    = $( '#email' ).val();
    var password = $( '#password' ).val();

    firebase.auth().signInWithEmailAndPassword( email, password )
        .catch( function( error ) {
            var errorCode = error.code;
            var errorMessage = error.message;
            console.log( 'Error Code ' + errorCode + ': ' + error_message );
        });
}
