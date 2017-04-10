<?
    lib_include( 'http_lib' );

    $event = $_REQUEST['event'];
    $role  = $_REQUEST['needed_role'];

    $data = get_http_json( "{$GLOBALS[API_BASE]}/event/$event/roles/$role" );

    if( !empty( $data ) )
        $estimated_expenses = $data['estimated_budget'];
    else
        $estimated_expenses = '';
?>
<div id="wrapper">
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6" style="width:100%">
                    <h1 class="page-header">Budget Manager</h1>
                    <form role="form">
                        <div class="form-group">
                            <label for="estimated">Estimated Expenses</label>
                            <input type="number" name = "estimated" width="30" id="estimated_expenses" value="<?= $estimated_expenses ?>"/>
                        </div>
                        <div class="form-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Expenses History
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="edit_budget_pagination_controls" class="paginationjs"></div>
                                    <br />
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Expenses</th>
                                                </tr>
                                            </thead>
                                            <tbody id="event_entity_role_tbody"></tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->

                        <div class="form-group">
                            <button type="submit" id="submit_button" class="btn btn-default">Submit</button>
                        </div>
                        <div class="form-group">
                            <label for="estimated">Total Expenses</label>
                            <input type="number" name = "estimated" width="30"/>
                        </div>
                    </form>
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
<script src="/planner/js/modal/edit_budget.js"></script>
<script type="text/javascript">
    var event_pk       = <?= $_REQUEST['event'] ?>;
    var needed_role_pk = <?= $_REQUEST['needed_role'] ?>;
</script>
