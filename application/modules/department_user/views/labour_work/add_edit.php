<?php
if (isset($LabourWorkDetail)) {
    $id = $LabourWorkDetail->id;
    $customer_id = $LabourWorkDetail->customer_id;
    $sheet_size = $LabourWorkDetail->sheet_size;
    $part_id = $LabourWorkDetail->part_id;
    $part_code_id = $LabourWorkDetail->part_code_id;
    $strip_size = $LabourWorkDetail->strip_size;
    $material_grade = $LabourWorkDetail->material_grade;
    $gross_weight = $LabourWorkDetail->gross_weight;
    $net_weight = $LabourWorkDetail->net_weight;
    $quantity = $LabourWorkDetail->quantity;
    $operator = $LabourWorkDetail->operator;
    $machine_id = $LabourWorkDetail->machine_id;
    $scrap_size = $LabourWorkDetail->scrap_size;
    $batch_no = $LabourWorkDetail->batch_no;
    $job_card_type = $LabourWorkDetail->job_card_type;
    $mode          = 'Edit';
} else {
    $id = '';
    $customer_id = '';
    $sheet_size = '';
    $part_id = '';
    $part_code_id = '';
    $strip_size = '';
    $material_grade = '';
    $gross_weight = '';
    $net_weight = '';
    $quantity = '';
    $operator = '';
    $machine_id = '';
    $scrap_size = '';
    $batch_no = '';
    $job_card_type = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/labour_work">Labour Work List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Labour Work</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Labour Work</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>department_user/labour_work/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : Company Details -->
                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <select name="customer_id" class="custom-select select2">
                                                <?php foreach ($AllCustomer as $_AllCustomer) {
                                                    $selected = "";
                                                    if ($_AllCustomer->id == $customer_id) {
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?php echo $_AllCustomer->id; ?>" <?php echo $selected; ?>><?php echo $_AllCustomer->customer_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sheet Size</label>
                                            <input type="text" class="form-control" id="sheet_size" name="sheet_size" value="<?php echo $sheet_size; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Part Name</label>
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
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Part Code</label>
                                            <select name="part_code_id" class="custom-select select2">
                                                <?php foreach ($AllPart as $_AllPart) {
                                                    $selected = "";
                                                    if ($_AllPart->id == $part_code_id) {
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?php echo $_AllPart->id; ?>" <?php echo $selected; ?>><?php echo $_AllPart->part_code; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Strip Size</label>
                                            <input type="text" class="form-control" id="strip_size" name="strip_size" value="<?php echo $strip_size; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Material Grade</label>
                                            <input type="text" class="form-control" id="material_grade" name="material_grade" value="<?php echo $material_grade; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gross Weight</label>
                                            <input type="text" class="form-control" id="gross_weight" name="gross_weight" value="<?php echo $gross_weight; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Net Weight</label>
                                            <input type="text" class="form-control" id="net_weight" name="net_weight" value="<?php echo $net_weight; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Operator</label>
                                            <input type="text" class="form-control" id="operator" name="operator" value="<?php echo $operator; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Machine</label>
                                            <select name="machine_id" class="custom-select select2">
                                                <?php foreach ($AllMachine as $_AllMachine) {
                                                    $selected = "";
                                                    if ($_AllMachine->id == $machine_id) {
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?php echo $_AllMachine->id; ?>" <?php echo $selected; ?>><?php echo $_AllMachine->machine_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Scrap Size</label>
                                            <input type="text" class="form-control" id="scrap_size" name="scrap_size" value="<?php echo $scrap_size; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Batch no</label>
                                            <input type="text" class="form-control" id="batch_no" name="batch_no" value="<?php echo $batch_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Job Card Type</label>
                                            <select name="job_card_type" class="custom-select select2">
                                                <option value="F.G" <?php if($job_card_type == 'F.G'){ echo $selected; }?>>F.G</option>
                                                <option value="R.M" <?php if($job_card_type == 'R.M'){ echo $selected; }?>>R.M</option>
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
        $(function() {

            // Setup form validation on the #register-form element
            $("#departmentUser-master").validate({
                // Specify the validation rules
                rules: {
                    sheet_size: "required",
                    strip_size: "required",
                    material_grade: "required",
                    gross_weight: "required",
                    net_weight: "required",
                    quantity: "required",
                    operator: "required",
                    scrap_size: "required",
                    batch_no: "required",
                },

                // Specify the validation error messages
                messages: {
                    sheet_size: "Please enter a sheet size",
                    strip_size: "Please enter strip size",
                    material_grade: "Please enter material grade",
                    gross_weight: "Please enter gross weight",
                    net_weight: "Please enter net weight",
                    quantity: "Please enter quantity",
                    operator: "Please enter operator",
                    scrap_size: "Please enter scrap size",
                    batch_no: "Please enter batch no",
                }

            });

        });
    });
</script>