<?
    function get_guests_by_event( $event_pk )
    {
        $ROLE_GUEST = constant( 'ROLE_GUEST' );
        $data_url   = "{$GLOBALS[API_BASE]}/event/$event_pk/guests/?role=$ROLE_GUEST";
        $data       = get_http_json( $data_url );
        return $data;
    }
?>
