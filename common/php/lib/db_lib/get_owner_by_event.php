<?
    function get_owner_by_event( $event_pk )
    {
        $ROLE_OWNER = constant( 'ROLE_OWNER' );
        $data_url   = "{$GLOBALS[API_BASE]}/event/$event_pk/owner/?role=$ROLE_OWNER";
        $data       = get_http_json( $data_url );
        return $data;
    }
?>
