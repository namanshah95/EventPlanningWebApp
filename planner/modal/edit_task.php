<?
    db_include(
        'get_guests_with_role',
        'get_guests_without_role'
    );

    $event = $_REQUEST['event'];
    $role  = $_REQUEST['role'];

    $guests_with_role    = get_guests_with_role( $event, $role );
    $guests_without_role = get_guests_without_role( $event, $role );
?>
<div id="wrapper">
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12" style="width: 350px">
                    <h1 class="page-header">Task Manager</h1>
                     <body>
                        <p>Assign People to Task</p>
                        <div style="float: left">
                            Unassigned
                            <br />
                            <select id="unassigned" multiple="multiple" style="width: 150px">
                                <? foreach( $guests_without_role as $guest ): ?>
                                    <option value="<?= $guest['entity'] ?>">
                                        <?= $guest['entity_name'] ?>
                                    </option>
                                <? endforeach ?>
                            </select>
                        </div>
                        <div style="float: right">
                            Assigned
                            <br />
                            <select id="assigned" multiple="multiple" style="width: 150px">
                                <? foreach( $guests_with_role as $guest ): ?>
                                    <option value="<?= $guest['entity'] ?>">
                                        <?= $guest['entity_name'] ?>
                                    </option>
                                <? endforeach ?>
                            </select>
                        </div>
                        <br />
                        <br />
                        <div style="float: left">
                            <input type="button" id="left_all" value="<<" />
                            <input type="button" id="left" value="<" />
                        </div>
                        <div style="float: right">
                            <input type="button" id="right" value=">" />
                            <input type="button" id="right_all" value=">>" />
                        </div>
                    </body>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<script src="/planner/js/modal/edit_task.js"></script>
<script type="text/javascript">
    var event_pk = <?= $event ?>;
    var role_pk  = <?= $role ?>;
</script>
