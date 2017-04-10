$( document ).ready( edit_budget_initialize );

var edit_budget_changed_values = {};

function edit_budget_initialize()
{
    var edit_budget_class_file = 'GetGuestsWithRolePaginator';
    var edit_budget_args       = {
        'event' : event_pk,
        'role'  : needed_role_pk
    };

    var limit = 15;

    pagination_init(
        $( '#edit_budget_pagination_controls' ),
        edit_budget_class_file,
        edit_budget_args,
        limit,
        populate_event_entity_role_table
    );

    $( '#submit_button' ).click( send_update_event_entity_roles_request );
}

function populate_event_entity_role_table( data, paginator )
{
    var event_entity_role_tbody = $( '#event_entity_role_tbody' );

    event_entity_role_tbody.empty();

    $.each( data, function( i, event_entity_role ) {
        var name     = $( '<td>' ).text( event_entity_role['entity_name'] );
        var expenses = event_entity_role['estimated_budget'] || 0;

        var expenses_input    = $( '<input type="number" id="' + event_entity_role['entity'] + '" value="' + expenses + '">' );
        var expenses_input_td = $( '<td>' ).append( expenses_input );

        expenses_input.change( function() {
            edit_budget_changed_values[this.id] = this.value;
        });

        var row = $( '<tr>' );

        row.append(
            name,
            expenses_input_td
        );

        event_entity_role_tbody.append( row );
    });
}

function send_update_event_entity_roles_request( event )
{
    event.preventDefault();

    var submit_button = $( '#submit_button' );

    submit_button.text( 'Submitting...' );

    var estimated_expenses = {
        'estimated_budget' : $( '#estimated_expenses' ).val()
    };

    $.ajax( {
        'type'     : 'PUT',
        'url'      : API_BASE + '/event/' + event_pk + '/roles/' + needed_role_pk,
        'data'     : estimated_expenses,
        'dataType' : 'json'
    })
    .fail( function( response, textStatus, jqXHR ) {
        js_error( 'Failed to update expenses.', BUDGET_EXPENSES_UPDATE_FAILURE );
    });

    for( var entity in edit_budget_changed_values )
    {
        var data = {
            'estimated_budget' : edit_budget_changed_values[entity]
        };

        $.ajax( {
            'type'     : 'PUT',
            'url'      : API_BASE + '/event/' + event_pk + '/entities/' + entity + '/roles/' + needed_role_pk,
            'data'     : data,
            'dataType' : 'json'
        })
        .fail( function( response, textStatus, jqXHR ) {
            js_error( 'Failed to update expenses.', BUDGET_EXPENSES_ENTITY_UPDATE_FAILURE );
        });
    }

    submit_button.text( 'Submitted' );

    setTimeout( function() {
        submit_button.text( 'Submit' );
    }, 5000 );
}
