<?
    function ajax_return_and_exit( $data )
    {
        $payload = json_encode( $data );
        header( 'Content-type:application/json;charset=utf-8' );
        echo( $payload );
        exit;
    }
?>
