<?
    function get_guests_without_role( $event, $role )
    {
        $eventPK = $_REQUEST['event'];
        $rolePK  = $_REQUEST['role'];

        $dataURL            = "{$GLOBALS[API_BASE]}/event/$eventPK/guests/";
        $data               = get_http_json( $dataURL );
        $entities_with_role = [];

        foreach( $data as $record )
        {
            if( $record['role'] == $rolePK )
                $entities_with_role[] = $record['entity'];
        }

        $real_data = [];

        foreach( $data as &$record )
        {
            if( !in_array( $record['entity'], $entities_with_role ) )
            {
                $entity        = $record['entity'];
                $entityDataURL = "{$GLOBALS[API_BASE]}/entities/$entity";
                $entityData    = get_http_json( $entityDataURL );

                $record['entity_name'] = $entityData['Name'];

                $real_data[] = $record;
            }
        }

        return $real_data;
    }
?>
