$( document ).ready( event_list_initialize );

function event_list_initialize()
{
    pagination_init(
        $( '#event_list_pagination_controls' ),
        'GetEventsPaginator',
        [],
        15,
        populate_event_table
    );
}

function populate_event_table( data, paginator )
{
    var event_list_tbody = $( '#event_list_tbody' );

    event_list_tbody.empty();

    $.each( data, function( i, event ) {
        var number = $( '<td>' ).text( i + 1 );
        var name   = $( '<td>' ).text( event['name'] );

        var row = $( '<tr>' );

        row.append(
            number,
            name
        );

        row.click( function() {
            set_session_event( event['event'] )
        });

        event_list_tbody.append( row );
    });
}
