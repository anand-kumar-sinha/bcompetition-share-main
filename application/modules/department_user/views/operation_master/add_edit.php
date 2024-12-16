<?php
if (isset($OperationDetail)) {
    $id = $OperationDetail->id;
    $operation_name = $OperationDetail->operation_name;
    $operation_code = $OperationDetail->operation_code;
    $status = $OperationDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $operation_name = '';
    $operation_code = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/operation_master">Operation List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Operation</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Operation</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="Operation-form" method="post" action="<?php echo base_url();?>department_user/operation_master/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : Company Details -->
                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Operation Name</label>
                                            <input type="text" class="form-control" id="operation_name" name="operation_name" value="<?php echo $operation_name; ?>">
                                        </div>
                                    </div>
<!--                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Operation Code</label>
                                            <input type="text" class="form-control" id="operation_code" name="operation_code" value="<?php echo $operation_code; ?>">
                                        </div>
                                    </div>-->
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

        $(function() {

            // Setup form validation on the #register-form element
            $("#Operation-form").validate({
                // Specify the validation rules
                rules: {
                    operation_name: "required",
                    operation_code: "required",
                },

                // Specify the validation error messages
                messages: {
                    operation_name: "Please enter a operation name",
                    operation_code: "Please enter a operation code",
                }

            });

        });
    });
</script>