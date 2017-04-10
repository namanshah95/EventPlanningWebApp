<?
    class GetEventRolesPaginator extends Paginator
    {
        protected function getData()
        {
            $eventPK = $_REQUEST['event'];
            $dataURL = "{$GLOBALS[API_BASE]}/event/$eventPK/guests/?role=-2&limit={$this->limit}&offset={$this->offset}";
            return json_decode( get_http( $dataURL ), true );
        }
    }
?>
