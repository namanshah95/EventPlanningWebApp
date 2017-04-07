<?
    function get_entity_session_by_key( $key )
    {
        $get_session_query = <<<SQL
select entity_session,
       entity,
       accessed,
       value,
       extract( epoch from now() - accessed ) as age_seconds
  from tb_entity_session
 where key = ?key?
SQL;

        $params = [ 'key' => $key ];
        $result = query_execute( $get_session_query, $params );

        return query_success( $result ) ? query_fetch_one( $result ) : false;
    }
?>
