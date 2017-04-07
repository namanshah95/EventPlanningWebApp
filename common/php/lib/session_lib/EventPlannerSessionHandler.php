<?
    db_include(
        'get_entity_session_by_key',
        'create_or_update_entity_session_by_key',
        'delete_entity_session_by_key',
        'delete_stale_entity_sessions'
    );

    class EventPlannerSessionHandler implements SessionHandlerInterface
    {
        private $dbHandle;
        private $cookie;

        const _SESSION_NAME            = 'eventplanner';
        const _SESSION_TIMEOUT_SECONDS = 3600;

        const _LIFETIME  = 'lifetime';
        const _PATH      = 'path';
        const _DOMAIN    = 'domain';
        const _SECURE    = 'secure';
        const _HTTP_ONLY = 'http_only';

        public function __construct()
        {
            $this->cookie = [
                self::_LIFETIME  => 0,
                self::_PATH      => '/',
                self::_DOMAIN    => $_SERVER['SERVER_NAME'],
                self::_SECURE    => ( @$_SERVER['HTTPS'] ?: false ),
                self::_HTTP_ONLY => true
            ];

            ini_set( 'session.use_cookies',      1 );
            ini_set( 'session.use_only_cookies', 1 );

            session_name( self::_SESSION_NAME );

            session_set_cookie_params(
                $this->cookie[self::_LIFETIME],
                $this->cookie[self::_PATH],
                $this->cookie[self::_DOMAIN],
                $this->cookie[self::_SECURE],
                $this->cookie[self::_HTTP_ONLY]
            );
        }

        public function open( $save_path, $session_name )
        {
            $this->dbHandle = get_or_connect_to_db();
            return $this->dbHandle !== null;
        }

        public function close()
        {
            return true;
        }

        public function read( $session_id )
        {
            $session = get_entity_session_by_key( $session_id );

            if( !is_array( $session ) )
                return '';

            if( $session['age_seconds'] >= self::_SESSION_TIMEOUT_SECONDS )
            {
                $this->destroy( $session_id );
                return '';
            }

            return $session['value'];
        }

        public function write( $session_id, $data )
        {
            $entity_session_columns = [
                'entity'   => SessionLib::get( 'user_entity.entity' ),
                'value'    => $data,
                'accessed' => 'now()'
            ];

            $session = create_or_update_entity_session_by_key( $session_id, $entity_session_columns );
            return $session !== false;
        }

        public function destroy( $session_id )
        {
            setcookie(
                self::_SESSION_NAME,
                '',
                time() - 42000,
                $this->cookie[self::_PATH],
                $this->cookie[self::_DOMAIN],
                $this->cookie[self::_SECURE],
                $this->cookie[self::_HTTP_ONLY]
            );

            delete_entity_session_by_key( $session_id );
            return true;
        }

        public function gc( $lifetime )
        {
            //delete_stale_entity_sessions( $lifetime );
            return true;
        }
    }
?>
