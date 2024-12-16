<?php
if (isset($MachineDetail)) {
    $id            = $MachineDetail->id;
    $machine_name  = $MachineDetail->machine_name;
    $machine_code  = $MachineDetail->machine_code;
    $year  = $MachineDetail->year;
    $company_name  = $MachineDetail->company_name;
    $capacity  = $MachineDetail->capacity;
    $status  = $MachineDetail->status;
    $check_sheet  = $MachineDetail->check_sheet;
    $mode          = 'Edit';
} else {
    $id        = '';
    $machine_name        = '';
    $machine_code        = '';
    $year        = '';
    $company_name        = '';
    $capacity        = '';
    $status        = '';
    $check_sheet        = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/machine_master">Machine List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Machine</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Machine</h3>
            </div>
            <div class="card-body">
                <form id="machine-master" method="post" action="<?php echo base_url(); ?>/department_user/machine_master/action" enctype="multipart/form-data" novalidate="novalidate">
                    <!-- Start : Company Details -->
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <!-- Start ROW -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Machine Name</label>
                                <input type="text" class="form-control" id="machine_name" name="machine_name" value="<?php echo $machine_name; ?>">
                            </div>
                        </div>
<!--                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Machine Code</label>
                                <input type="text" class="form-control" id="machine_code" name="machine_code" value="<?php echo $machine_code; ?>">
                            </div>
                        </div>-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Capacity</label>
                                <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo $capacity; ?>">
                            </div>
                        </div>
                    </div>
                    <!-- End ROW -->
                    <!-- Start ROW -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text" class="form-control" id="year" name="year" value="<?php echo $year; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Check Sheet</label>
                                <input id="check_sheet" name="check_sheet" type="file" class="form-control">
                               
                            </div>
                        </div>
                        <?php  if (isset($check_sheet) && $check_sheet != '') { ?>
                             <div class="col-md-2">
                                 <br>
                                <input id="old_check_sheet" name="old_check_sheet" type="hidden" class="form-control" <?php echo $check_sheet;?>> 
                                <a class="btn btn-primary btn-sm" id="download" href="<?php echo base_url() ?>uploads/machine_image/<?php  echo $check_sheet; ?>" download="<?php  echo $check_sheet; ?>">Download</a>
                            </div> 
                        <?php } ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="custom-select">
                                    <option value="Active" <?php if ($status == 'Active') echo 'selected'; ?>>Active</option>
                                    <option value="Deactive" <?php if ($status == 'Deactive') echo 'selected'; ?>>Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

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

        $(function() {

            // Setup form validation on the #register-form element
            $("#machine-master").validate({
                // Specify the validation rules
                rules: {
                    machine_name: "required",
                    machine_code: "required",
                    year: {
                        required: true,
                        number: true,
                        minlength: 4,
                        maxlength: 4,
                    },
                    company_name: "required",
                    capacity: "required",
                    status: "required"
                },

                // Specify the validation error messages
                messages: {
                    machine_name: "Please enter machine name",
                    machine_code: "Please enter machine code",
                    year: {
                        required: "Enter year",
                        number: "Enter only number",
                        maxlength: "Please enter maximum 4 latters in Number",
                        minlength: "Please enter minimum 4 latters in Number",
                    },
                    company_name: "Please enter company name",
                    capacity: "Please enter capacity",
                    status: "Please Selects status"
                }

            });

        });
    });
</script>