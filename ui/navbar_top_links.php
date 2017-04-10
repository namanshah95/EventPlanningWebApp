<?
    db_include( 'get_events' );

    $events = get_events( 6 );
?>
<script src="/ui/js/navbar_top_links.js"></script>
<ul class="nav navbar-top-links navbar-right">
    <li>
        <b>
            <? if( SessionLib::get( 'event.pk' ) !== -1 ): ?>
                <span>On Event: <?= SessionLib::get( 'event.name' ) ?></span>
            <? else: ?>
                <span style="color: red"><b>Choose An Event &#x21E8</b></span>
            <? endif; ?>
        </b>
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-tasks">
            <? foreach( $events as $event ): ?>
                <li>
                    <a href="#" onclick="set_session_event( <?= $event['event'] ?> );"><?= $event['name'] ?></a>
                    <li class="divider"></li>
                </li>
            <? endforeach; ?>
            <li>
                <a class="text-center" href="eventlist.php">
                    <strong>See All Events</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-tasks -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->
