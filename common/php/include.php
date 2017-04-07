<?
    function lib_include()
    {
        $args = func_get_args();

        foreach( $args as $arg )
            require_once( "{$GLOBALS[WEBROOT]}/common/php/lib/$arg.php" );
    }
    
    /*
     * Includes a db_lib function.
     *
     * Params:
     *   Any number of db_lib function names (in common/db_lib). Do not include
     *   the ".php" at the end of the name.
     * Returns:
     *   Nothing.
     */
    function db_include()
	{
        $args = func_get_args();

        foreach( $args as $arg )
            require_once( "{$GLOBALS[WEBROOT]}/common/php/lib/db_lib/$arg.php" );
	}

    /*
     * Includes a Javascript plugin.
     *
     * Params:
     *   Any number of Javascript plugin names (in common/js). Do include
     *   the ".js" at the end of the name.
     * Returns:
     *   Nothing.
     */
    function js_include()
    {
        $args = func_get_args();

        $js_lookup_table = [
            'jquery' => '/ext/jquery-3.1.1.min.js',
        ];

        foreach( $args as $arg )
        {
            if( isset( $js_lookup_table[$arg] ) )
                $arg = $js_lookup_table[$arg];

            echo "<script src=\"/common/js/$arg\"></script>";
        }
    }

    function js_common_include()
    {
        js_include(
            'jquery'
        );
    }
?>
