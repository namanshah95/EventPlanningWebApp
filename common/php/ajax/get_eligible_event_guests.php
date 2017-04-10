<?
    db_include(
        'get_entities',
        'get_guests_by_event',
        'get_owner_by_event'
    );

    $event = $_REQUEST['event'];

    $entities = get_entities();
    $guests   = get_guests_by_event( $event );
    $owner    = get_owner_by_event( $event );

    $guest_pks = [];

    foreach( $guests as $guest )
        $guest_pks[] = $guest['entity'];

    $owner_pk = $owner[0]['entity'];
    $eligible = [];

    foreach( $entities as $entity )
    {
        $entity_pk    = $entity['entity'];
        $entity_name  = $entity['Name'];
        $entity_email = $entity['Email'];

        if( $entity_pk != $owner_pk && !in_array( $entity_pk, $guest_pks ) )
            $eligible[$entity_pk] = "$entity_name ($entity_email)";
    }

    $retval = [
        'success' => true,
        'data'    => $eligible
    ];

    ajax_return_and_exit( $retval );
?>
