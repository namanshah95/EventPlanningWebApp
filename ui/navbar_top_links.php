<?
    db_include( 'get_events' );

    $events = get_events( 6 );
?>
<link rel="stylesheet" type="text/css" href="/featherlight.min.css" />
<? js_include( 'featherlight' ) ?>
<script src="/ui/js/navbar_top_links.js"></script>
<ul class="nav navbar-top-links navbar-right">
    <li>
        <? if( SessionLib::get( 'event.pk' ) !== -1 ): ?>
            <span><b>On Event:</b></span> <?= SessionLib::get( 'event.name' ) ?>
        <? else: ?>
            <span><b>Choose An Event &#x21E8</b></span>
        <? endif; ?>
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-tasks">
            <? foreach( $events as $event ): ?>
                <li>
                    <a href="javascript:void(0)" onclick="set_session_event( <?= $event['event'] ?> );"><?= $event['name'] ?></a>
                    <li class="divider"></li>
                </li>
            <? endforeach; ?>
            <li>
                <a class="text-center" href="/planner/modal/event_list.php" data-featherlight="ajax">
                    <strong>See All Events</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-tasks -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->
