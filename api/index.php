<?
    require_once( "{$GLOBALS['webroot']}/lib/api_lib.php" );

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
