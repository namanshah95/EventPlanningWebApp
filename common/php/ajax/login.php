<?
    $ext_firebase_id = $_REQUEST['ext_firebase_id'];
    $success         = login( $ext_firebase_id );
    ajax_return_and_exit( [ 'success' => $success] );
?>
