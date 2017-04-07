<?
    function delete_entity_session_by_key( $key )
    {
        $delete_entity_session_query = <<<SQL
delete from tb_entity_session
      where key = ?key?
SQL;

        $params = [ 'key' => $key ];
        $delete = query_execute( $delete_entity_session_query, $params );

        return query_success( $delete );
    }
?>
