<?
    function delete_stale_entity_sessions( $seconds )
    {
        $delete_query = <<<SQL
delete from tb_entity_session
      where accessed < now() - interval '?seconds? seconds'
SQL;

        $params = [ 'seconds' => $seconds ];
        $delete = query_execute( $delete_blog_post_query, $params );

        return query_success( $delete );
    }
?>
