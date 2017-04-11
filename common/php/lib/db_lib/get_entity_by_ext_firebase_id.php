<?
    function get_entity_by_ext_firebase_id( $ext_firebase_id )
    {
        $query = <<<SQL
select entity
  from tb_entity
 where ext_firebase_id = ?ext_firebase_id?
SQL;

        $params   = [ 'ext_firebase_id' => $ext_firebase_id ];
        $resource = query_execute( $query, $params );

        if( query_success( $resource ) )
        {
            $record = query_fetch_one( $resource );
            return $record;
        }

        return false;
    }
?>
