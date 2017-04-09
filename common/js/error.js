var BUDGET_EXPENSES_ENTITY_UPDATE_FAILURE = 100;
var BUDGET_EXPENSES_UPDATE_FAILURE        = 101;

var GENERIC_ERROR      = 300;
var PAGINATION_FAILURE = 301;

function lpad( error_code )
{
    var str    = '' + error_code;
    var pad    = '0000';
    var retval = pad.substring( 0, pad.length - str.length ) + str;
    return retval;
}

function js_error( message, error_code )
{
    alert( message + ' (Error Code: ' + lpad( error_code ) + ')' );
}

function js_generic_error( page_url )
{
    js_error( 'An error has occurred - please contact support.', GENERIC_ERROR );
}
