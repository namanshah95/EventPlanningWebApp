<?
    class GetEventGuestsPaginator extends Paginator
    {
        protected function getData()
        {
            $eventPK = $_REQUEST['event'];
            $dataURL = "{$GLOBALS[API_BASE]}/event/$eventPK/guests/?role=-2&limit={$this->limit}&offset={$this->offset}";
            $data = get_http_json( $dataURL );

            // Avoid a second API lookup if we can avoid it
            //if( isset( $_REQUEST['_total'] ) && $_REQUEST['_total'] )
                //return $data;

            foreach( $data as &$record )
            {
                $entity        = $record['entity'];
                $entityDataURL = "{$GLOBALS[API_BASE]}/entities/$entity";
                $entityData    = get_http_json( $entityDataURL );

                $record['entity_name'] = $entityData['Name'];
            }

            return $data;
        }
    }
?>
