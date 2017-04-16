<?
    require_once( "{$GLOBALS[WEBROOT]}/common/php/lib/session_lib/SessionLib.php" );
    require_once( "{$GLOBALS[WEBROOT]}/common/php/lib/session_lib/EventPlannerSessionHandler.php" );

    db_include( 'get_entity_by_ext_firebase_id' );

    function set_session_save_handler()
    {
        static $handler_set = false;

        if( !$handler_set )
        {
            $session_handler = new EventPlannerSessionHandler();
            session_set_save_handler( $session_handler, true );
            $handler_set = true;
        }
    }

    function is_logged_in()
    {
        return SessionLib::get( 'user_entity.entity' ) != -1;
    }

    function login( $ext_firebase_id )
    {
        $entity = get_entity_by_ext_firebase_id( $ext_firebase_id );

        if( is_array( $entity ) && count( $entity ) == 1 )
        {
            SessionLib::set( 'user_entity.entity', $entity['entity'] );
            SessionLib::closeSession();

            return true;
        }

        return false;
    }

    function signup( $ext_firebase_id )
    {
        $entity = create_entity_by_ext_firebase_id( $ext_firebase_id );

        if( is_array( $entity ) && count( $entity ) == 1 )
        {
            SessionLib::set( 'user_entity.entity', $entity['entity'] );
            SessionLib::closeSession();

            return true;
        }

        return false;
    }

    function logout()
    {
        SessionLib::destroySession();
    }
?>
