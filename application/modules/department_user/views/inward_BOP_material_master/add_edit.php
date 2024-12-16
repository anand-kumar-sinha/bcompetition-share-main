<?php
if (isset($InwardBOPDetail)) {
    $id            = $InwardBOPDetail->id;
    $inward_material_name  = $InwardBOPDetail->inward_material_name;
    $BOP_code  = $InwardBOPDetail->BOP_code;
    $description  = $InwardBOPDetail->description;
    $status  = $InwardBOPDetail->status;
    $mode          = 'Edit';
} else {
    $id        = '';
    $inward_material_name        = '';
    $BOP_code        = '';
    $description        = '';
    $status        = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/inward_BOP_material_master">Inward BOP Material List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Inward BOP Material</li>
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
                <h3 class="card-title">Add Inward BOP Material</h3>
            </div>
            <div class="card-body">
                <form id="BOP-master" method="post" action="<?php echo base_url(); ?>department_user/inward_BOP_material_master/action" enctype="multipart/form-data" novalidate="novalidate">
                    <!-- Start : Company Details -->
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <!-- Start ROW -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Inward BOP Material Name</label>
                                <input type="text" class="form-control" id="inward_material_name" name="inward_material_name" value="<?php echo $inward_material_name; ?>">
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label>BOP Code</label>
                                <input type="text" class="form-control" id="BOP_code" name="BOP_code" value="<?php echo $BOP_code; ?>">
                            </div>
                        </div> -->
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
                    <!-- End ROW -->
                    <!-- Start ROW -->
                    <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                                <label>description</label>
                                <textarea type="textarea" class="form-control" id="description" name="description"><?php echo $description; ?></textarea>
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
            $("#BOP-master").validate({
                // Specify the validation rules
                rules: {
                    inward_material_name: "required",
                    // BOP_code: "required",
                    description: "required",
                    status: "required"
                },

                // Specify the validation error messages
                messages: {
                    inward_material_name: "Please enter inward BOP material name",
                    // BOP_code: "Please enter BOP code",
                    description: "Please enter description",
                    status: "Please Selects status"
                }

            });

        });
    });
</script>