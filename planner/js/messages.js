$( document ).ready( messages_initialize );

function messages_initialize()
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
}

function send_message(convo_id)
{
    var text        = $( '#txt-chat' ).val();
    var sender      = firebase.auth().currentUser.uid;
    var datetime    = new Date();
    var mon=datetime.getMonth()+1;
    var day=datetime.getDate();
    var year=("" + datetime.getFullYear()).slice(-2);
    var format ="AM";
    var hour=datetime.getHours();
    var min=datetime.getMinutes();
    if(hour>11){format="PM";}
    if (hour   > 12) { hour = hour - 12; }
    if (hour   == 0) { hour = 12; }

    datetime = mon + "/" + day + "/" + year + " " + hour + ":" + min + " " + format;

    if (text !== "") {
        var key = firebase.database().ref().child("messages").child(convo_id).push().key;
        firebase.database().ref().child("messages").child(convo_id).child(key).set({
            Datetime: datetime,
            Sender: sender,
            Text: text
        });
    }
    $( '#txt-chat' ).val("");
}