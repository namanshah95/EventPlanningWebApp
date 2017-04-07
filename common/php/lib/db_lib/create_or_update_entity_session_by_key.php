<?
    function create_or_update_entity_session_by_key( $key, $param_map )
    {
        $query = <<<SQL
select entity_session
  from tb_entity_session
 where key = ?key?
 limit 1
SQL;

        $param_map['key'] = $key;
        
        $resource = query_execute( $query, $param_map );
        
        if( query_success( $resource ) )
        {
            $entity_session = query_fetch_one( $resource );
            
            if( $entity_session !== null )
            {                
                $upsert_query = <<<SQL
   update tb_entity_session
      set value    = ?value?,
          accessed = ?accessed?,
          entity   = ?entity?
    where key      = ?key?
returning entity_session
SQL;
            }
            else
            {
                $upsert_query = <<<SQL
insert into tb_entity_session
(
    entity,
    accessed,
    key,
    value
)
values
(
    ?entity?,
    ?accessed?,
    ?key?,
    ?value?
)
returning entity_session
SQL;
            }

            $resource = query_execute( $upsert_query, $param_map );
            
            if( query_success( $resource ) )
            {
                $retval = query_fetch_one( $resource );
                return $retval['entity_session'];
            }
        }

        return false;
    }
?>
