<?
    $event_pk = $_REQUEST['event'];

    $data_url   = "{$GLOBALS[API_BASE]}/events/$event_pk";
    $event_data = get_http_json( $data_url );

    if( is_array( $event_data ) )
    {
        $event_name = $event_data['name'];

        SessionLib::set( 'event.pk', $event_pk );
        SessionLib::set( 'event.name', $event_name );

        $success = true;
    }
    else
        $success = false;

    $retval = [ 'success' => $success ];
    ajax_return_and_exit( $retval );
?>
