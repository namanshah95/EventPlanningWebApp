<?
    $__sql_hostname =    getenv( 'EVENT_PLANNER_PRODUCTION' )
                      || ( getenv( 'EVENT_PLANNER_DEVELOPMENT' ) && !getenv( 'NO_LOCAL_DB' ) )
              ? 'localhost'
              : 'planmything.tech';

    $__sql_db = getenv( 'EVENT_PLANNER_PRODUCTION' )
              ? 'planmyth_prod'
              : 'planmyth_dev';

    // SQL
    define( 'PSQL_HOST',           $__sql_hostname );
    define( 'PSQL_PORT',           '5432'          );
    define( 'PSQL_DB'  ,           $__sql_db       );
    define( 'PSQL_USER',           'planmyth_user' );
    define( 'PSQL_PASSWORD',       'EsVNg4EGuk'    ); // We are super fucking secure here lmao
    define( 'PSQL_CONNECT_STRING', ' host='     . constant( 'PSQL_HOST' )
                                 . ' port='     . constant( 'PSQL_PORT' )
                                 . ' dbname='   . constant( 'PSQL_DB' )
                                 . ' user='     . constant( 'PSQL_USER' )
                                 . ' password=' . constant( 'PSQL_PASSWORD' ) );

    // API errors
    define( 'HTTP_OK',                    200 );
    define( 'HTTP_BAD_REQUEST',           400 );
    define( 'HTTP_NOT_FOUND',             404 );
    define( 'HTTP_INTERNAL_SERVER_ERROR', 500 );

    // Roles
    define( 'ROLE_OWNER', -1 );
    define( 'ROLE_GUEST', -2 );

    // Firebase credentials (100% secure trust me)
    define( 'FIREBASE_URL',     'https://event-planner-160406.firebaseio.com/' );
    define( 'FIREBASE_AUTHKEY', 'cKZjwjMSN66IYC4bC8IDYx4CqySfSKaLIXKvofsq'     );

    // Globals
    define( 'WEBROOT',   'webroot'   );
    define( 'DB_HANDLE', 'db_handle' );
    define( 'HOSTNAME',  'hostname'  );
    define( 'API_BASE',  'api_base'  );
?>
