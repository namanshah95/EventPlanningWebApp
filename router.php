<?
    /*
     * EVERY PHP REQUEST GOES THROUGH THIS FILE (see .htaccess in webroot)
     * PLEASE BE VERY CAREFUL WHEN MAKING CHANGES
     */

    // Set the webroot
    if( isset( $_SERVER['CONTEXT_DOCUMENT_ROOT'] ) && $_SERVER['CONTEXT_DOCUMENT_ROOT'] )
        $GLOBALS['webroot'] = $_SERVER['CONTEXT_DOCUMENT_ROOT'];
    elseif( isset( $_SERVER['DOCUMENT_ROOT'] ) && $_SERVER['DOCUMENT_ROOT'] )
        $GLOBALS['webroot'] = $_SERVER['DOCUMENT_ROOT'];

    // Require the necessary includes
    require_once( "{$GLOBALS['webroot']}/common/php/constants.php" );
    require_once( "{$GLOBALS['webroot']}/common/php/include.php" );
    require_once( "{$GLOBALS['webroot']}/vendor/autoload.php" );

    lib_include( 'db_lib' );
    lib_include( 'session_lib' );

    // Initialize the database connection
    get_or_connect_to_db();

    // Start a session
    set_session_save_handler();
    SessionLib::startSession();
    SessionLib::registerSession();

    // Make sure we can access the page we want
    $requested_page = $_REQUEST['_file'];

    if( isset( $requested_page ) && file_exists( $requested_page ) )
    {
        if( preg_match( '/^common\/php\/ajax\/.+\.php$/', $requested_page ) )
        {
            lib_include( 'ajax_lib' );
            require_once( $requested_page );
        }
        else
            require_once( $requested_page );
    }
    else
        require_once( '404.shtml' );

    exit;
?>
