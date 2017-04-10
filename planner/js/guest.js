$( document ).ready( guest_initialize );

var TEST_EVENT = 44; // TODO remove this hard-coded test value

var class_file = "GetEventGuestsPaginator";
var args       = {
    'event' : TEST_EVENT
};

var limit = 15;

// var edit_task_unassigned = new Set();
// var edit_task_assigned   = new Set();

function guest_initialize()
{
    pagination_init(
        $( '#guest_pagination_controls' ),
        class_file,
        args,
        limit,
        populate_guest_list_table
    );
}

// function add_new_row()
// {
//     var guest_list_tbody = $( '#guest_list_tbody' );
//     var row             = $( '<tr id="new">' );

//     var guest_name_input = $( '<td>' )
//         .append( '<input type="text" id="new_name">' );

//     var add_button = $( '<td> ')
//         .append( '<input type="button" class="add" value="Add New Guest">' );

//     add_button.click( create_new_guest );

//     row.append(
//         guest_name_input,
//         add_button
//     );

//     guest_list_tbody.append( row );
// }

// function create_action_set( tr, event_entity_role, entity )
// {
//     var actions = $( '<td>' );

//     var delete_button = $( '<input type="button" value="Delete" class="delete">' );


//     // delete_button.click( function() {
//     //     purge_role( tr, needed_role );
//     // });

//     actions.append(
//         //edit_name,
//         delete_button
//     );

//     return actions;
// }

// function purge_role( tr, needed_role )
// {
//     tr.hide();

//     $.ajax( {
//         'type'     : 'DELETE',
//         'url'      : API_BASE + '/event/' + TEST_EVENT + '/roles/' + needed_role,
//         'dataType' : 'json'
//     });

//     var get_url = API_BASE + '/event/' + TEST_EVENT + '/guests/?role=' + needed_role;
//     var entities = [];

//     $.get( get_url, null, function( response, textStatus, jqXHR ) {
//         for( var record in response )
//             entities.push( record['entity'] );
//     }, 'json');

//     for( var entity in entities )
//     {
//         $.ajax( {
//             'type'     : 'DELETE',
//             'url'      : API_BASE + '/event/' + TEST_EVENT + '/guests/' + entity + '/roles/' + needed_role,
//             'dataType' : 'json'
//         });
//     }
// }

function populate_guest_list_table( data, pagination )
{
    console.log("h");
    var guest_list_tbody = $( '#guest_list_tbody' );

    guest_list_tbody.empty();

    $.each( data, function( i, event_entity_role ) {
        document.write(5);
        var event_entity_role_pk = event_entity_role['event_entity_role'];
        var row                  = $( '<tr>' );

        var guest_name = $( '<td>' ).text( event_entity_role['entity'] );
        //var actions   = create_action_set( row, event_entity_role_pk, event_entity_role['entity'] );

        row.append(
            guest_name
            //actions
        );

        guest_list_tbody.append( row );
    });

    //add_new_row();
}

// function create_new_guest()
// {
//     var new_name  = $( '#new_name' ).val();
//     var post_url  = 'http://planmything.tech/api/roles/';
//     var post_data = { 'name' : new_name };

//     var new_needed_role;
//     var new_event_needed_role;

//     $.post( post_url, post_data, function( response, textStatus, jqXHR ) {
//         new_needed_role = response['role'];
//         console.log( new_needed_role );
//     })
//     .done( function() {
//         post_url  = 'http://planmything.tech/api/event/' + TEST_EVENT + '/roles/';
//         post_data = { 'needed_role' : new_needed_role };

//         $.post( post_url, post_data, function( response, textStatus, jqXHR ) {
//             new_event_needed_role = response['event_needed_role'];
//             console.log( new_event_needed_role );
//         });
//     });

//     var new_row = $( '#new' );
//     new_row.empty();

//     var task_name = $( '<td>' ).text( new_name );
//     var actions   = create_action_set( new_row, new_event_needed_role, new_needed_role );

//     new_row.append(
//         task_name,
//         actions
//     );

//     new_row.removeAttr( 'id' );
//     add_new_row();
// }

// function perform_edit_task_update()
// {
//     var post_data = { 'role' : role_pk };

//     edit_task_assigned.forEach( function( entity ) {
//         var post_url = 'http://planmything.tech/api/event/' + event_pk + '/entities/' + entity + '/roles/';

//         $.post( post_url, post_data, function( response, textStatus, jqXHR ) {
//             console.log( response['event_entity_role'] );
//         }, 'json' );
//     });

//     edit_task_unassigned.forEach( function( entity ) {
//         $.ajax( {
//             'type'     : 'DELETE',
//             'url'      : 'http://planmything.tech/api/event/' + event_pk + '/guests/' + entity + '/roles/' + role_pk,
//             'dataType' : 'json'
//         })
//         .fail( function() {
//             console.log( 'Error happened' );
//         })
//     });

//     edit_task_assigned.clear();
//     edit_task_unassigned.clear();
// }
