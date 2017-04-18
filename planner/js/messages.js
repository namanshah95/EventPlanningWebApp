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
    // Get event id
    var i = 0;
    firebase.database().ref().child('messages').child(convoid).on("child_added", function(snapshot, prevKey) {
        var side = "left";
        var oppside = "right";
        if (snapshot.val().Sender === firebase.auth().currentUser.uid) { 
            side = "right";
            oppside = "left";
        }
        //var name = set_sender_name(snapshot.val().Sender);
        var html = "";
        html += '<li class="'+side+' clearfix">\n';
        html += '<span class="chat-img pull-'+side+'">\n';
        html += '<img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />\n';
        html += '</span>\n';
        html += '<div class="chat-body pull-'+side+' clearfix">\n';
        html += '<div class="header">\n';
        html += '<strong class="primary-font" id="'+i+'"></strong>\n';
        //html += '<small class="pull-'+side+' text-muted">\n';
        //html += '<i class="fa fa-clock-o fa-fw"></i> 12 mins ago\n';
        //html += '</small>\n';
        html += '</div>\n';
        html += '<p>'+snapshot.val().Text+'</p>\n';
        html += '</div>\n';
        html += '</li>\n';
        $("#chat-list").append(html);
        set_sender_name(i, snapshot.val().Sender);
        i += 1;
    });
    $("#chat-panel").scrollTop($("#chat-panel")[0].scrollHeight);
}

function send_message()
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
        var key = firebase.database().ref().child("messages").child(convoid).push().key;
        firebase.database().ref().child("messages").child(convoid).child(key).set({
            Datetime: datetime,
            Sender: sender,
            Text: text
        });
        $("#chat-panel").scrollTop($("#chat-panel")[0].scrollHeight);
    }
    $( '#txt-chat' ).val("");
}

function set_sender_name(i, sender) {
    firebase.database().ref().child("users").child(sender).once("value", function(snapshot) {
        $('#' + i).html(snapshot.val().Name);
    });
}