$( document ).ready( task_initialize );

var TEST_EVENT = 14; // TODO remove this hard-coded test value

var class_file = "GetEventRolesPaginator";
var args       = {
    'event' : TEST_EVENT
};

var limit = 15;

var edit_task_unassigned = new Set();
var edit_task_assigned   = new Set();

function task_initialize()
{
    pagination_init(
        $( '#task_pagination_controls' ),
        class_file,
        args,
        limit,
        populate_task_list_table
    );
}

function populate_task_list_table( data, pagination )
{
    var task_list_tbody = $( '#task_list_tbody' );

    task_list_tbody.empty();

    $.each( data, function( i, event_needed_role ) {
        var event_needed_role_pk = event_needed_role['event_needed_role'];
        var row                  = $( '<tr id="' + event_needed_role_pk + '">' );

        var task_name = $( '<td>' ).text( event_needed_role['needed_role_name'] );
        var actions   = $( '<td>' );

        var edit_name     = $( '<input type="button" value="Edit Assignments" class="edit">' );
        var delete_button = $( '<input type="button" value="Delete" class="delete">' );

        edit_name.click( function() {
            $.featherlight(
                "/planner/modal/edit_task.php?event=" + TEST_EVENT + "&role=" + event_needed_role['needed_role'],
                {
                    'beforeClose' : perform_edit_task_update // defined in edit_task.js
                }
            );
        });

        delete_button.click( function() {
            $( '#' + event_needed_role_pk ).hide();

            // TODO ajax delete
        });

        actions.append(
            edit_name,
            delete_button
        );

        row.append(
            task_name,
            actions
        );

        task_list_tbody.append( row );
    });

    var row = $( '<tr>' );

    var role_name_input = $( '<td>' )
        .append( '<input type="text" id="new_name">' );

    var add_button = $( '<td> ')
        .append( '<input type="button" class="add" value="Add New Task">' );

    add_button.click( create_new_role );

    row.append(
        role_name_input,
        add_button
    );

    task_list_tbody.append( row );
}

function create_new_role()
{
    var new_name = $( '#new_name' ).val();
}

function perform_edit_task_update()
{
    var post_data = { 'role' : role_pk };

    edit_task_assigned.forEach( function( entity ) {
        var post_url = 'http://planmything.tech/api/event/' + event_pk + '/entities/' + entity + '/roles/';

        $.post( post_url, post_data, function( response, textStatus, jqXHR ) {
            console.log( response['event_entity_role'] );
        }, 'json' );
    });

    edit_task_unassigned.forEach( function( entity ) {
        $.ajax( {
            'type'     : 'DELETE',
            'url'      : 'http://planmything.tech/api/event/' + event_pk + '/guests/' + entity + '/roles/' + role_pk,
            'dataType' : 'json'
        })
        .fail( function() {
            console.log( 'Error happened' );
        })
    });

    edit_task_assigned.clear();
    edit_task_unassigned.clear();
}
