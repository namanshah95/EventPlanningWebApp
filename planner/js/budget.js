$( document ).ready( budget_initialize );

var TEST_EVENT = 14; // TODO remove this hard-coded test value

function budget_initialize()
{
    var class_file = 'GetEventRolesPaginator';
    var args       = {
        'event' : TEST_EVENT
    };

    var limit = 15;

    pagination_init(
        $( '#budget_pagination_controls' ),
        class_file,
        args,
        limit,
        populate_needed_roles_table
    );
}

function populate_needed_roles_table( data, pagination )
{
    var needed_roles_tbody = $( '#needed_roles_tbody' );

    needed_roles_tbody.empty();

    $.each( data, function( i, event_needed_role ) {
        var event_needed_role_pk_val = event_needed_role['event_needed_role'];
        var needed_role_pk           = event_needed_role['needed_role'];

        var event_needed_role_pk = $( '<td>' ).text( i + 1 );
        var role_name            = $( '<td>' ).text( event_needed_role['needed_role_name'] );

        var row = $( '<tr>' );

        row.append(
            event_needed_role_pk,
            role_name
        );

        row.click( function() {
            $.featherlight( '/planner/modal/edit_budget.php?event=' + TEST_EVENT + "&needed_role=" + needed_role_pk );
        });

        needed_roles_tbody.append( row );
    });
}
