$( document ).ready( edit_task_initialize );

function edit_task_initialize()
{
    $( '#left' ).click( function() {
        move_items( '#assigned', '#unassigned' );
    });

    $( '#right' ).click( function() {
        move_items( '#unassigned', '#assigned' );
    });

    $( '#left_all' ).click( function() {
        move_all_items( '#assigned', '#unassigned' );
    });

    $( '#right_all' ).click( function () {
        move_all_items( '#unassigned', '#assigned' );
    });
}

function move_items( origin, dest )
{
    var selected = $( origin ).find( ':selected' );
    selected.appendTo( dest );

    if( dest == '#assigned' )
    {
        $( dest + ' option:selected' ).each( function( i, item ) {
            var entity = item.value;
            edit_task_assigned.add( entity );
            edit_task_unassigned.delete( entity );
        });
    }
    else
    {
        $( dest + ' option:selected' ).each( function( i, item ) {
            var entity = item.value;
            edit_task_assigned.delete( entity );
            edit_task_unassigned.add( entity );
        });
    }
}

function move_all_items( origin, dest )
{
    var all = $( origin ).children();
    all.appendTo( dest );

    if( dest == '#assigned' )
    {
        $( dest + ' > option' ).each( function( i, item ) {
            var entity = item.value;
            edit_task_assigned.add( entity );
            edit_task_unassigned.delete( entity );
        });
    }
    else
    {
        $( dest + ' > option' ).each( function( i, item ) {
            var entity = item.value;
            edit_task_assigned.delete( entity );
            edit_task_unassigned.add( entity );
        });
    }
}
