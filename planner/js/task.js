$( document ).ready( task_initialize );

var edit_task_unassigned = new Set();
var edit_task_assigned   = new Set();

function task_initialize()
{
    var class_file = "GetEventRolesPaginator";
    var args       = {
        'event' : SESSION_EVENT_PK
    };

    var limit = 15;

    pagination_init(
        $( '#task_pagination_controls' ),
        class_file,
        args,
        limit,
        populate_task_list_table
    );

    add_new_row();
}

function add_new_row()
{
    var task_list_tbody = $( '#task_list_tbody' );
    var row             = $( '<tr id="new">' );

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

function create_action_set( tr, event_needed_role, needed_role )
{
    var actions = $( '<td>' );

    var edit_name     = $( '<input type="button" value="Edit Assignments" class="edit">' );
    var delete_button = $( '<input type="button" value="Delete" class="delete">' );

    edit_name.click( function() {
        $.featherlight(
            "/planner/modal/edit_task.php?event=" + SESSION_EVENT_PK + "&role=" + needed_role,
            {
                'beforeClose' : perform_edit_task_update // defined in edit_task.js
            }
        );
    });

    delete_button.click( function() {
        purge_role( tr, needed_role );
    });

    actions.append(
        edit_name,
        delete_button
    );

    return actions;
}

function purge_role( tr, needed_role )
{
    tr.hide();

    $.ajax( {
        'type'     : 'DELETE',
        'url'      : API_BASE + '/event/' + SESSION_EVENT_PK + '/roles/' + needed_role,
        'dataType' : 'json'
    });

    var get_url = API_BASE + '/event/' + SESSION_EVENT_PK + '/guests/?role=' + needed_role;
    var entities = [];

    $.get( get_url, null, function( response, textStatus, jqXHR ) {
        for( var record in response )
            entities.push( record['entity'] );
    }, 'json');

    for( var entity in entities )
    {
        $.ajax( {
            'type'     : 'DELETE',
            'url'      : API_BASE + '/event/' + SESSION_EVENT_PK + '/guests/' + entity + '/roles/' + needed_role,
            'dataType' : 'json'
        });
    }
}

function populate_task_list_table( data, pagination )
{
    var task_list_tbody = $( '#task_list_tbody' );

    task_list_tbody.empty();

    $.each( data, function( i, event_needed_role ) {
        var event_needed_role_pk = event_needed_role['event_needed_role'];
        var row                  = $( '<tr>' );

        var task_name = $( '<td>' ).text( event_needed_role['needed_role_name'] );
        var actions   = create_action_set( row, event_needed_role_pk, event_needed_role['needed_role'] );

        row.append(
            task_name,
            actions
        );

        task_list_tbody.append( row );
    });
}

function create_new_role()
{
    var new_name  = $( '#new_name' ).val();
    var post_url  = API_BASE + '/roles/';
    var post_data = { 'name' : new_name };

    var new_needed_role;
    var new_event_needed_role;

    $.post( post_url, post_data, function( response, textStatus, jqXHR ) {
        new_needed_role = response['role'];
        console.log( new_needed_role );
    })
    .done( function() {
        post_url  = API_BASE + '/event/' + SESSION_EVENT_PK + '/roles/';
        post_data = { 'needed_role' : new_needed_role };

        $.post( post_url, post_data, function( response, textStatus, jqXHR ) {
            new_event_needed_role = response['event_needed_role'];
            console.log( new_event_needed_role );
        });
    });

    var new_row = $( '#new' );
    new_row.empty();

    var task_name = $( '<td>' ).text( new_name );
    var actions   = create_action_set( new_row, new_event_needed_role, new_needed_role );

    new_row.append(
        task_name,
        actions
    );

    new_row.removeAttr( 'id' );
    add_new_row();
}

function perform_edit_task_update()
{
    var post_data = { 'role' : role_pk };

    edit_task_assigned.forEach( function( entity ) {
        var post_url = API_BASE + '/event/' + event_pk + '/entities/' + entity + '/roles/';

        $.post( post_url, post_data, function( response, textStatus, jqXHR ) {
            console.log( response['event_entity_role'] );
        }, 'json' );
    });

    edit_task_unassigned.forEach( function( entity ) {
        $.ajax( {
            'type'     : 'DELETE',
            'url'      : API_BASE + '/event/' + event_pk + '/guests/' + entity + '/roles/' + role_pk,
            'dataType' : 'json'
        })
        .fail( function() {
            console.log( 'Error happened' );
        })
    });

    edit_task_assigned.clear();
    edit_task_unassigned.clear();
}
