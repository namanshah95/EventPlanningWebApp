<?
    /*
     * Performs an HTTP GET request on the specified URL.
     */
    function get_http( $url )
    {
        $ch = curl_init( $url );

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_HEADER, 0 );

        $retval = curl_exec( $ch );

        curl_close( $ch );
        return $retval;
    }

    function get_http_json( $url )
    {
        return json_decode( get_http( $url ), true );
    }
?>
