<?
    lib_include( 'http_lib' );

    class SessionLib
    {
        private static $sessionStarted    = false;
        private static $sessionClosed     = false;
        private static $sessionRegistered = false;

        private function __construct()
        {
            return;
        }

        private static function isValidSession()
        {
            $obsolete = self::get( 'obsolete' );
            $expires  = self::get( 'expires'  );

            if( $obsolete && !$expires )
                return false;

            if( isset( $expires ) && $expires < time() )
                return false;

            return true;
        }

        private static function isValidUserIPAndAgent()
        {
            $ipAddress = self::get( 'ip_address' );
            $userAgent = self::get( 'user_agent' );

            if( $ipAddress === null || $userAgent === null )
                return false;

            if( $ipAddress != $_SERVER['REMOTE_ADDR'] )
                return false;

            if( $userAgent != $_SERVER['HTTP_USER_AGENT'] )
                return false;

            return true;
        }

        public static function startSession()
        {
            if( !self::$sessionStarted )
            {
                self::$sessionStarted = true;

                session_start();

                if( !self::isValidSession() )
                {
                    $_SESSION = [];
                    session_destroy();
                    session_start();
                }

                return true;
            }
            else
            {
                error_log( "Tried to start a session more than once!" );
                return false;
            }
        }

        public static function regenerateSession()
        {
            if( !self::get( 'obsolete' ) )
            {
                self::set( 'obsolete', true        );
                self::set( 'expires',  time() + 10 );

                session_regenerate_id( false );
                $newSessionID = session_id();
                session_write_close();

                session_id( $newSessionID );
                session_start();

                self::deset( 'obsolete' );
                self::deset( 'expires'  );
            }
        }

        public static function closeSession()
        {
            if( self::$sessionClosed )
                error_log( "Tried to close the same session twice!" );
            elseif( !self::$sessionStarted )
                error_log( "Tried to close session before starting one!" );
            elseif( !self::$sessionRegistered )
                error_log( "Tried to close an unregistered session!" );
            else
            {
                self::$sessionClosed = true;
                session_write_close();

                return true;
            }

            return false;
        }

        public static function registerSession()
        {
            if( self::$sessionStarted )
            {
                self::$sessionRegistered = true;
                $sessionMember           = self::get( 'user_entity.entity' );

                if( $sessionMember === null )
                    self::set( 'user_entity.entity', -1 );
                elseif( $sessionMember != -1 )
                {
                    $entity = json_decode( get_http( "{$GLOBALS['webroot']}/api/entities/$sessionMember" ), true );
                    SessionLib::set( 'user_entity.Name',  $entity['Name'] );
                    SessionLib::set( 'user_entity.Email', $entity['Email']   );
                }

                $sessionEvent = self::get( 'event.pk' );

                if( $sessionEvent === null )
                    self::set( 'event.pk', -1 );

                return true;
            }
            else
            {
                error_log( "Tried to register the same session twice!" );
                return false;
            }
        }

        public static function clearSession()
        {
            session_unset();
        }

        public static function destroySession()
        {
            self::clearSession();
            return session_destroy();
        }

        public static function set( $key, $value )
        {
            if( self::$sessionStarted )
            {
                $parsedKey =  explode( '.', $key );
                $session   =& $_SESSION;

                while( count( $parsedKey ) > 1 )
                {
                    $subkey = array_shift( $parsedKey );

                    if( !isset( $session[$subkey] ) || !is_array( $session[$subkey] ) )
                        $session[$subkey] = [];

                    $session =& $session[$subkey];
                }

                $subkey           = array_shift( $parsedKey );
                $session[$subkey] = $value;

                return true;
            }
            else
            {
                error_log( "Tried to set \$_SESSION[$key] = $value before session started!" );
                return false;
            }
        }

        public static function get( $key )
        {
            if( self::$sessionStarted )
            {
                $parsedKey = explode( '.', $key );
                $result    = $_SESSION;

                while( $parsedKey )
                {
                    $subkey = array_shift( $parsedKey );

                    if( isset( $result[$subkey] ) )
                        $result = $result[$subkey];
                    else
                        return null;
                }

                return $result;
            }
            else
            {
                error_log( "Tried to get the value of \$_SESSION[$key] before session started!" );
                return null;
            }
        }

        public static function deset( $key )
        {
            if( self::$sessionStarted )
            {
                $parsedKey =  explode( '.', $key );
                $session   =& $_SESSION;

                while( count( $parsedKey ) > 1 )
                {
                    $subkey = array_shift( $parsedKey );

                    if( !isset( $session[$subkey] ) || !is_array( $session[$subkey] ) )
                        $session[$subkey] = [];

                    $session =& $session[$subkey];
                }

                $subkey = array_shift( $parsedKey );
                deset( $session[$subkey] );

                return true;
            }
            else
            {
                error_log( "Tried to deset \$_SESSION[$key] before session started!" );
                return false;
            }
        }
    }
?>
