<?
    function create_or_update_entity_session_by_key( $key, $param_map )
    {
        $query = <<<SQL
insert into tb_entity
(
    ext_firebase_id
)
values
(
    ?ext_firebase_id?
)
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