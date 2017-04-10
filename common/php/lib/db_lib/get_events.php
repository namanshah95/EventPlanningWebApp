<?
    function get_events( $limit )
    {
        $query = <<<SQL
  select count(*) over () as total,
         event,
         name,
         start_time,
         end_time,
         created
    from tb_event
  -- where start_time > now()
order by start_time
   limit ?limit?
SQL;

        $params = [ 'limit' => $limit ];

        $resource = query_execute( $query, $params );

        if( query_success( $resource ) )
            return query_fetch_all( $resource );

        return false;
    }
?>
