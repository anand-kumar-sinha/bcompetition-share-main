<?php
if (isset($QualityDetail)) {
    $id = $QualityDetail->id;
    $quality_date = date("d-m-Y", strtotime($QualityDetail->quality_date));
    $part_id = $QualityDetail->part_id;
    $qc_inspector = $QualityDetail->qc_inspector;
    $total_inspected_qty = $QualityDetail->total_inspected_qty;
    $rejected_qty = $QualityDetail->rejected_qty;
    $rework_qty = $QualityDetail->rework_qty;
    $problem_statement = $QualityDetail->problem_statement;
    $remark = $QualityDetail->remark;
    $final_ok_qty = $QualityDetail->final_ok_qty;
    $job_card_number = $QualityDetail->job_card_number;
    $status = $QualityDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $quality_date = '';
    $part_id = '';
    $qc_inspector = '';
    $total_inspected_qty = '';
    $rejected_qty = '';
    $rework_qty = '';
    $problem_statement = '';
    $remark = '';
    $final_ok_qty = '';
    $job_card_number = '';
    $status = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/quality">Quality List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Quality</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Quality</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>admin/quality/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : Company Details -->
                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control" id="quality_date" name="quality_date" value="<?php echo $quality_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Part Name / Code /BOM</label>
                                            <select name="part_id" class="custom-select select2">
                                                <?php foreach ($AllPart as $_AllPart) {
                                                    $selected = "";
                                                    if ($_AllPart->id == $part_id) {
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?php echo $_AllPart->id; ?>" <?php echo $selected; ?>><?php echo $_AllPart->part_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>QC Inspector</label>
                                            <input type="text" class="form-control" id="qc_inspector" name="qc_inspector" value="<?php echo $qc_inspector; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Inspected Qty</label>
                                            <input type="text" class="form-control" id="total_inspected_qty" name="total_inspected_qty" value="<?php echo $total_inspected_qty; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reject Qty</label>
                                            <input type="text" class="form-control" id="rejected_qty" name="rejected_qty" value="<?php echo $rejected_qty; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Rework Qty</label>
                                            <input type="text" class="form-control" id="rework_qty" name="rework_qty" value="<?php echo $rework_qty; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Problem Statement</label>
                                            <input type="text" class="form-control" id="problem_statement" name="problem_statement" value="<?php echo $problem_statement; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $remark; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Final Ok Qty</label>
                                            <input type="text" class="form-control" id="final_ok_qty" name="final_ok_qty" value="<?php echo $final_ok_qty; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Card Number</label>
                                            <input type="text" class="form-control" id="job_card_number" name="job_card_number" value="<?php echo $job_card_number; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="custom-select">
                                                <option value="Active" <?php if ($status == 'Active') echo 'selected'; ?>>Active</option>
                                                <option value="Deactive" <?php if ($status == 'Deactive') echo 'selected'; ?>>Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- End : Company Details -->
                                <div class="box-footer">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
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


<style>
    .error {
        color: red;
    }
</style>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        
        $('#quality_date').datepicker({
                format: "dd-mm-yyyy",
                todayHighlight: true,
                autoclose: true,
                orientation: "bottom", // <-- and add this
            });
//        $(function() {
//            $('input[name="quality_date"]').daterangepicker({
//                singleDatePicker: true,
//                showDropdowns: true,
//                minYear: 1901,
//                maxYear: parseInt(moment().format('YYYY'), 10)
//            }, function(start, end, label) {
//                var years = moment().diff(start, 'years');
//                alert("You are " + years + " years old!");
//            });
//        });

        $(function() {

            // Setup form validation on the #register-form element
            $("#departmentUser-master").validate({
                // Specify the validation rules
                rules: {
                    quality_date: "required",
                    qc_inspector: "required",
                    total_inspected_qty: {
                        required: true,
                        number: true,
                    },
                    rejected_qty: {
                        required: true,
                        number: true,
                    },
                    rework_qty: {
                        required: true,
                        number: true,
                    },
                    problem_statement: "required",
                    remark: "required",
                    final_ok_qty: {
                        required: true,
                        number: true,
                    },
                    job_card_number: "required"
                },

                // Specify the validation error messages
                messages: {
                    quality_date: "Please enter a date",
                    qc_inspector: "Please enter a qc inspector",
                    total_inspected_qty: {
                        required: "Please enter total inspected quantity",
                        number: "Enter only number",
                    },
                    rejected_qty: {
                        required: "Please enter rejected quantity",
                        number: "Enter only number",
                    },
                    rework_qty: {
                        required: "Please enter rework quantity",
                        number: "Enter only number",
                    },
                    problem_statement: "Please enter problem statement",
                    remark: "Please enter remark",
                    final_ok_qty: {
                        required: "Please enter final ok quantity",
                        number: "Enter only number",
                    },
                    job_card_number: "Please enter job card number"
                }

            });

        });
    });
</script>