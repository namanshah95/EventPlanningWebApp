<?
    function get_entities()
    {
        $data_url = "{$GLOBALS[API_BASE]}/entities/";
        $data     = get_http_json( $data_url );
        return $data;
    }
?>
