$( document ).ready( initialize );

var TEST_EVENT = 14; // TODO remove this hard-coded test value

var class_file = "GetEventRolesPaginator";
var args       = {
    'event' : TEST_EVENT
};

var limit = 15;

function initialize()
{
    pagination_init(
        class_file,
        args,
        limit,
        populate_task_list_table
    );
}

function populate_task_list_table( data, pagination )
{
    var task_list_tbody = $( '#task_list_tbody' );

    $.each( data, function( i, event_needed_role ) {
        var row = $( '<tr>' );

        var task_name = $( '<td>' ).text( event_needed_role['needed_role_name'] );
        var actions   = $( '<td>' );

        var edit_name     = $( '<input type="button" value="Edit Name" class="edit">' );
        var save          = $( '<input type="button" value="Save" class="save">' );
        var delete_button = $( '<input type="button" value="Delete" class="delete">' );

        edit_name.click( function() {
            $.featherlight( "/planner/edittask.php?event=" + TEST_EVENT );
        });

        actions.append(
            edit_name,
            save,
            delete_button
        );

        row.append(
            task_name,
            actions
        );

        task_list_tbody.append( row );
    });

    var add_new_task = $( '<tr>' );

    var role_name_input = $( '<input>' );
    var add_new_task_button = $( '<input>' );

    add_new_task.append(
        role_name_input,
        add_new_task_button
    )
}
