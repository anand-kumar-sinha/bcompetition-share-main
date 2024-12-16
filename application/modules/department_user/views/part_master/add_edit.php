<?php
if (isset($PartDetail)) {
    $id = $PartDetail->id;
    $customer_id = $PartDetail->customer_id;
    $part_name = $PartDetail->part_name;
    $part_code = $PartDetail->part_code;
    $status = $PartDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $customer_id = '';
    $part_name = '';
    $part_code = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/part_master">Part List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Part</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Part</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="Part-form" method="post" action="<?php echo base_url();?>department_user/part_master/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : Company Details -->
                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <select name="customer_id" class="custom-select select2">
                                                <?php foreach ($AllCustomer as $_AllCustomer) {
                                                    $selected = "";
                                                    if ($_AllCustomer->id == $customer_id) {
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?php echo $_AllCustomer->id; ?>" <?php echo $selected; ?>><?php echo $_AllCustomer->customer_name." (".$_AllCustomer->contact.")"; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Part Name</label>
                                            <input type="text" class="form-control" id="part_name" name="part_name" value="<?php echo $part_name; ?>">
                                        </div>
                                    </div>
<!--                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Part Code</label>
                                            <input type="text" class="form-control" id="part_code" name="part_code" value="<?php echo $part_code; ?>">
                                        </div>
                                    </div>-->
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
            $("#Part-form").validate({
                // Specify the validation rules
                rules: {
                    part_name: "required",
                    part_code: "required",
                },

                // Specify the validation error messages
                messages: {
                    part_name: "Please enter a part name",
                    part_code: "Please enter a part code",
                }

            });

        });
    });
</script>