<?
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
    lib_include( 'api_lib' );
    lib_include( 'session_lib' );

    // Initialize the database connection
    get_or_connect_to_db();

    // Start a session
    set_session_save_handler();
    SessionLib::startSession();
    SessionLib::registerSession();

    $config = [
        'settings' => [
            'displayErrorDetails'    => true,
            'addContentLengthHeader' => false
        ]
    ];

    $API = new \Slim\App( $config );

    $controllers = scandir( "{$GLOBALS['webroot']}/api/controllers" );
    $controllers = array_diff( $controllers, [ '..', '.' ] );

    foreach( $controllers as $controller )
        require_once( "{$GLOBALS['webroot']}/api/controllers/$controller" );

    $API->run();
?>
