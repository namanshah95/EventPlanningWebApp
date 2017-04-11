<? if( is_logged_in() ): ?>
    <script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
    <script src="/ui/js/sidebar.js"></script>
<? endif; ?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <? if( is_logged_in() ): ?>
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                </li>
                <? if( SessionLib::get( 'event.pk' ) !== -1 ): ?>
                    <li>
                        <a href="guest.php"><i class="fa fa-user fa-fw"></i> Guest List</a>
                    </li>
                    <li>
                        <a href="task.php"><i class="fa fa-tasks fa-fw"></i> Task Manager</a>
                    </li>
                    <li>
                        <a href="budget.php"><i class="fa fa-money fa-fw"></i> Budget Manager</a>
                    </li>
                <? endif; ?>
                <li>
                    <a href="messages.php"><i class="fa fa-commenting-o fa-fw"></i> Messages</a>
                </li>
                <li>
                    <a href="javascript:void(0)" id="logout_link"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            <? else: ?>
                <li>
                    <a href="login.php"><i class="fa fa-sign-in fa-fw"></i> Login</a>
                </li>
            <? endif; ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
