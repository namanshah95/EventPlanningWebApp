<?
    function get_guests_with_role( $event, $role )
    {
        $dataURL = "{$GLOBALS[API_BASE]}/event/$event/guests/?role=$role";
        $data    = get_http_json( $dataURL );

        foreach( $data as &$record )
        {
            $entity        = $record['entity'];
            $entityDataURL = "{$GLOBALS[API_BASE]}/entities/$entity";
            $entityData    = get_http_json( $entityDataURL );

            $record['entity_name'] = $entityData['Name'];
        }

        return $data;
    }
?>
