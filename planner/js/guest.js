$( document ).ready( guest_initialize );

function guest_initialize()
{
    var guest_class_file = "GetEventGuestsPaginator";
    var guest_args       = {
        'event' : SESSION_EVENT_PK
    };

    var limit = 15;

    pagination_init(
        $( '#guest_pagination_controls' ),
        guest_class_file,
        guest_args,
        limit,
        populate_guest_list_table
    );

    add_new_row();
}

function add_new_row()
{
    var guest_list_tbody = $( '#guest_list_tbody' );
    var row             = $( '<tr id="new">' );

    var guest_name_selector = $( '<select name="new_name" id="new_name">' );
    var guest_name_input    = $( '<td>' )
        .append( guest_name_selector );

    var get_route = '/common/php/ajax/get_eligible_event_guests.php';
    var data      = { 'event' : SESSION_EVENT_PK };

    $.get( get_route, data, function( response, textStatus, jqXHR ) {
        for( var entity in response['data'] )
        {
            guest_name_selector.append(
                $( '<option>' )
                    .attr( 'value', entity )
                    .text( response['data'][entity] )
            );
        }

        guest_name_selector.chosen( { 'width' : '300px' } );

        var add_button = $( '<td> ')
            .append( '<input type="button" class="add" value="Add New Guest">' );

        add_button.click( create_new_guest );

        row.append(
            guest_name_input,
            add_button
        );

        guest_list_tbody.append( row );
    }, 'json' );
}

function create_action_set( tr, entity_pk )
{
    var actions       = $( '<td>' );
    var delete_button = $( '<input type="button" value="Delete" class="delete">' );

    delete_button.click( function() {
        delete_member( tr, entity_pk );
    });

    actions.append( delete_button );
    return actions;
}

function delete_member( tr, entity_pk )
{
    tr.hide();

    $.ajax( {
        'type'     : 'DELETE',
        'url'      : API_BASE + '/event/' + SESSION_EVENT_PK + '/guests/' + entity_pk,
        'dataType' : 'json'
    });
}

function populate_guest_list_table( data, pagination )
{
    var guest_list_tbody = $( '#guest_list_tbody' );

    guest_list_tbody.empty();

    $.each( data, function( i, event_entity_role ) {
        var event_entity_role_pk = event_entity_role['event_entity_role'];
        var row                  = $( '<tr>' );

        var guest_name = $( '<td>' ).text( event_entity_role['entity_name'] );
        var actions    = create_action_set( row, event_entity_role['entity'] );

        row.append(
            guest_name,
            actions
        );

        guest_list_tbody.append( row );
    });
}

function create_new_guest()
{
    var new_entity = $( '#new_name' ).find( ':selected' )[0].value;
    var new_name   = $( '#new_name' ).find( ':selected' )[0].text;
    var post_url   = API_BASE + '/event/' + SESSION_EVENT_PK + '/guests/';
    var post_data  = { 'entity' : new_entity };

    $.post( post_url, post_data, function( response, textStatus, jqXHR ) {
        console.log( response );
    });

    var new_row = $( '#new' );
    new_row.empty();

    var guest_name = $( '<td>' ).text( new_name );
    var actions    = create_action_set( new_row, new_entity );

    new_row.append(
        guest_name,
        actions
    );

    new_row.removeAttr( 'id' );
    add_new_row();
}
