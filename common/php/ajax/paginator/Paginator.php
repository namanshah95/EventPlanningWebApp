<?
    lib_include( 'ajax_lib' );
    lib_include( 'http_lib' );

    abstract class Paginator
    {
        protected $limit;
        protected $offset;
        protected $requestData;
        protected $apiBase;

        public function __construct( $requestData )
        {
            $this->limit  = isset( $requestData['pageSize'] )
                          ? $requestData['pageSize']
                          : 1;

            $this->offset = isset( $requestData['pageNumber'] )
                          ? ( $requestData['pageNumber'] - 1 ) * $this->limit
                          : 0;

            $this->requestData = $requestData;
        }

        abstract protected function getData();

        public function run()
        {
            $data    = $this->getData();
            $success = $data !== false;
            $count   = $success ? count( $data ) : 0;

            $retval = [
                'success' => $success,
                'data'    => $data,
                'count'   => $count
            ];

            ajax_return_and_exit( $retval );
        }

        public function getTotal()
        {
            $data    = $this->getData();
            $success = $data !== false;
            $total   = $success && count( $data ) > 0 ? $data[0]['total'] : 0;

            $retval = [
                'success' => $success,
                'total'   => $total
            ];

            ajax_return_and_exit( $retval );
        }
    }
?>
