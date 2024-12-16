<?php
if (isset($scheduleData)) {
    $id = $scheduleData->id;
    $schedule_date = date("m/d/Y", strtotime($scheduleData->schedule_date));
    $status = $scheduleData->status;
    $scheduleDetail = $scheduleData->scheduleDetail;
    $mode          = 'Edit';
} else {
    $id = '';
    $challan_number = '';
    $ship_to = '';
    $vehicle_number = '';
    $schedule_date = '';
    $status = '';
    $scheduleDetail = '';
    $mode      = 'Add';
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/schedule">Schedule List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Schedule</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Schedule</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>department_user/schedule/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control date" id="schedule_date" name="schedule_date" value="<?= $schedule_date ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="custom-select">
                                                <option value="Active" <?php if ($status == 'Active') {
                                                                            echo 'selected';
                                                                        } ?>>Active</option>
                                                <option value="Deactive" <?php if ($status == 'Deactive') {
                                                                                echo 'selected';
                                                                            } ?>>Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->

                                <div id="dispatch_default_div">
                                    <input type="hidden" id="rm_form_attribute_row_count" value="1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Customer</label>
                                                <select name="customer_id[]" class="custom-select select2">
                                                    <?php foreach ($AllCustomer as $_AllCustomer) { ?>
                                                        <option value="<?php echo $_AllCustomer->id; ?>"><?php echo $_AllCustomer->customer_name.' ('.$_AllCustomer->contact.')'; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Part Name</label>
                                                <select name="part_name_id[]" class="custom-select">
                                                    <?php foreach ($AllPart as $_AllPart) { ?>
                                                        <option value="<?php echo $_AllPart->id; ?>"><?php echo $_AllPart->part_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Part Number</label>
                                                <select name="part_code_id[]" class="custom-select">
                                                    <?php foreach ($AllPart as $_AllPart) { ?>
                                                        <option value="<?php echo $_AllPart->id; ?>"><?php echo $_AllPart->part_code; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-1">
                                            <label>&nbsp;</label><br>
                                            <span class="btn btn-primary btn-sm" onclick="AddDispatchDiv();"><span class="fa fa-plus"></span></span>
                                        </div>
                                    </div>
                                    <!-- End ROW -->
                                    <!-- Start ROW -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Schedule</label>
                                                <input type="text" class="form-control" id="schedule" name="schedule[]" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Month</label>
                                                <input type="text" class="form-control" id="month" name="month[]" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Schedule No/PO No</label>
                                                <input type="text" class="form-control" id="schedule_no" name="schedule_no[]" value="">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End ROW -->
                                </div>

                                <div class="box-footer">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <?php if ($mode == "Edit") { ?>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Schedule sub Details</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Part Name / Code</th>
                                                    <th>Schedule</th>
                                                    <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                                </tr>
                                            </thead>
                                            <?php foreach ($scheduleDetail as $_scheduleDetail) { ?>
                                                <tr>
                                                    <td><?php echo $_scheduleDetail->customer_name; ?></td>
                                                    <td><?php echo $_scheduleDetail->part_name . ' / ' . $_scheduleDetail->part_code; ?></td>
                                                    <td><?php echo $_scheduleDetail->schedule; ?></td>

                                                    <td class="no-sort center-text-table">
                                                        <button class="btn btn-primary btn-xs" onclick="EditscheduleSubDetail(<?php echo $_scheduleDetail->id; ?>);"><i class="fas fa-edit"></i></button>
                                                        <a href="<?php echo base_url() . 'department_user/schedule/scheduleSubdelete/' . $_scheduleDetail->id . '/' . $id; ?>" onclick="return confirm('Are you sure?');">
                                                            <button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div id="OperationDetailDivPopup"></div>
<style>
    .error {
        color: red;
    }
</style>
<script>
    function AddDispatchDiv() {

        var tmp = 1;
        var count = $('#rm_form_attribute_row_count').val();
        $('#rm_form_attribute_row_count').val(parseInt(count) + parseInt(tmp));

        var html = '<div class="row Row_' + count + '">';
        html += '<div class="col-md-3"> ';
        html += '<div class="form-group">';
        html += '<label>Customer</label>';
        html += '<select name="customer_id[]" class="custom-select select2">';
        <?php foreach ($AllCustomer as $_AllCustomer) { ?>
            html += '<option value="<?php echo $_AllCustomer->id; ?> " ><?php echo $_AllCustomer->customer_name.' ('.$_AllCustomer->contact.')'; ?> </option>';
        <?php } ?>
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-3"> ';
        html += '<div class="form-group">';
        html += '<label>Part Name</label>';
        html += '<select name="part_name_id[]" class="custom-select">';
        <?php foreach ($AllPart as $_AllPart) { ?>
            html += '<option value="<?php echo $_AllPart->id; ?> " ><?php echo $_AllPart->part_name; ?> </option>';
        <?php } ?>
        html += '</select> ';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-3"> ';
        html += '<div class="form-group">';
        html += '<label>Part Number</label>';
        html += '<select name="part_code_id[]" class="custom-select">';
        <?php foreach ($AllPart as $_AllPart) { ?>
            html += '<option value="<?php echo $_AllPart->id; ?> " ><?php echo $_AllPart->part_code; ?> </option>';
        <?php } ?>
        html += '</select> ';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2"></div>';
        html += '<div class="col-md-1">';
        html += '<label>&nbsp;</label><br>';
        html += '<span class="btn btn-danger btn-sm" onclick="RemoveDispatchDiv(' + count + ');"><span class="fa fa-minus"></span></span>';
        html += '</div>';
        html += '</div>';
        html += '<div class="row Row_' + count + '">';
        html += '<div class="col-md-3"> ';
        html += '<div class="form-group">';
        html += '<label>Schedule</label>';
        html += '<input type="text" class="form-control" id="schedule" name="schedule[]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-3"> ';
        html += '<div class="form-group">';
        html += '<label>Month</label>';
        html += '<input type="text" class="form-control" id="month" name="month[]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-3"> ';
        html += '<div class="form-group">';
        html += '<label>Schedule No/PO No</label>';
        html += '<input type="text" class="form-control" id="schedule_no" name="schedule_no[]" value="">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $("#dispatch_default_div").append(html);
          $('.select2').select2();
    }

    function RemoveDispatchDiv(count) {
        $('.Row_' + count).remove();
    }
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $(function() {
            $('.date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
            });
        });
    });

    function EditscheduleSubDetail(schedule_detail_id) {
        $.ajax({
            url: "<?php echo base_url() . "department_user/schedule/edit_sub_schedule_detail"; ?>",
            method: "POST",
            data: {
                schedule_detail_id: schedule_detail_id
            },
            success: function(data) {
                $('#OperationDetailDivPopup').html(data);
                $('#OperationDetailDivModal').modal('show');
            }
        });
    }
</script>