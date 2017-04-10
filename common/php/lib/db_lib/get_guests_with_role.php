<?
    function get_guests_with_role( $event, $role )
    {
        $dataURL = "http://planmything.tech/api/event/$event/guests/?role=$role";
        $data    = get_http_json( $dataURL );

        foreach( $data as &$record )
        {
            $entity        = $record['entity'];
            $entityDataURL = "http://planmything.tech/api/entities/$entity";
            $entityData    = get_http_json( $entityDataURL );

            $record['entity_name'] = $entityData['Name'];
        }

        return $data;
    }
?>
