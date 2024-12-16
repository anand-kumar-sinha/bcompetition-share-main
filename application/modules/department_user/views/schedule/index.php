<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Schedule List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-6 float-sm-left">
                                <h3 class="card-title">Schedule List</h3>
                            </div>
                            <div class="col-sm-6 float-sm-right right-add">
                                <a class="top-btn right-button" href="<?php echo base_url() . 'department_user/schedule/add_edit/'; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                    <button class="btn btn-primary btn-xs"><span class="fa fa-plus-circle"></span> Add</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Schedule Number</th>
                                        <th>Customer</th>
                                        <th>Part Name / Code</th>
                                        <th>Schedule</th>
                                        <th>Month</th>
                                        <th>Schedule No/PO No</th>
                                        <th>Status</th>
                                        <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <?php foreach ($AllScheduleList as $_AllScheduleList) {
                                    if ($_AllScheduleList->status == "Active") {
                                        $btnClass = "btn-success";
                                    } else {
                                        $btnClass = "btn-danger";
                                    } ?>
                                    <tr>
                                        <td><?php echo $_AllScheduleList->schedule_number; ?></td>
                                        <td><?php $br = ''; foreach($_AllScheduleList->schedule_detail as $value) {
                                                echo $br.$value->customer_name.' ('.$value->contact.')';
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td><?php $br = ''; foreach($_AllScheduleList->schedule_detail as $value) {
                                                echo $br.$value->part_name.'/'.$value->part_code;
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td><?php $br = ''; foreach($_AllScheduleList->schedule_detail as $value) {
                                                echo $br.$value->schedule;
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td><?php $br = ''; foreach($_AllScheduleList->schedule_detail as $value) {
                                                echo $br.$value->month;
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td><?php $br = ''; foreach($_AllScheduleList->schedule_detail as $value) {
                                                echo $br.$value->schedule_no;
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td>
                                            <button class="btn btn-block btn-xs <?php echo $btnClass; ?>"><?php echo $_AllScheduleList->status; ?></button>
                                        </td>
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'department_user/schedule/add_edit/' . $_AllScheduleList->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                            </a>
                                            <a href="<?php echo base_url() . 'department_user/schedule/delete/' . $_AllScheduleList->id; ?>" onclick="return confirm('Are you sure?');">
                                                <button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->