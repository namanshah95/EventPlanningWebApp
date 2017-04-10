$( document ).ready( navbar_top_links_initialize );

function navbar_top_links_initialize()
{
    return;
}

function set_session_event( event_pk )
{
    var url  = '/common/php/ajax/set_session_event.php';
    var data = { 'event' : event_pk };

    $.post( url, data, function() {
        window.location.reload();
    }, 'json' )
    .fail( function() {
        console.log( 'Something went wrong.' );
    });
}
