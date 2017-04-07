<?
    class GetEventRolesPaginator extends Paginator
    {
        protected function getData()
        {
            $eventPK = $_REQUEST['event'];

            //$ch = curl_init( "{$GLOBALS['webroot']}/api/events/$eventPK/roles/" );
            $ch = curl_init( "http://planmything.tech/api/event/14/roles/" );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_HEADER, 0 );
            $retval = json_decode( curl_exec( $ch ), true );
            curl_close( $ch );

            return $retval;
        }
    }
?>
