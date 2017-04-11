$( document ).ready( sidebar_initialize );

function sidebar_initialize()
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
        if( !user )
        {
            var url = '/common/php/ajax/logout.php';

            $.post( url, null, function( response, textStatus, jqXHR ) {
                alert( 'You have been logged out.' );
                window.location = '/planner/index.php';
            }, 'json' );
        }
    });

    $( '#logout_link' ).click( logout );
}

function logout()
{
    firebase.auth().signOut();
}
