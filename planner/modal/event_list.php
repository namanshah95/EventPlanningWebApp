<link rel="stylesheet" type="text/css" href="/pagination.css" />
<script src="/planner/js/modal/event_list.js"></script>
<? js_include( 'pagination', 'error.js', 'pagination_lib.js' ); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6" style="width:100%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Event List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="event_list_pagination_controls" class="paginationjs"></div>
                    <br />
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" align="center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event Name</th>
                                </tr>
                            </thead>
                            <tbody id="event_list_tbody"></tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
</div>
