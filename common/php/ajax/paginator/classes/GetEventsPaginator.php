<?
    class GetEventsPaginator extends Paginator
    {
        protected function getData()
        {
            $dataURL = "{$GLOBALS[API_BASE]}/events/?limit={$this->limit}&offset={$this->offset}";
            return get_http_json( $dataURL );
        }
    }
?>
