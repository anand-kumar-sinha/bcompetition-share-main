<?php
if (isset($AllDepartment)) {
    $id = $AllDepartment->id;
    $department_name = $AllDepartment->department_name;
    $status = $AllDepartment->status;
    $mode          = 'Edit';
            
} else {
    $id = '';
    $department_name = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/department_master">Department List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Department</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Department</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <form id="department-form" method="post" action="https://digisysindiatech.com/shivautotech/admin/department_master/action" enctype="multipart/form-data" novalidate="novalidate">
                            <!-- Start : Company Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <!-- Start ROW -->
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Department Name</label>
                                        <input type="text" class="form-control" id="department_name" name="department_name" value="<?php echo $department_name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="custom-select">
                                            <option value="Active" <?php if($status == "Active") echo 'active'; ?>>Active</option>
                                            <option value="Deactive" <?php if($status == "Deactive") echo 'active'; ?>>Deactive</option>
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
      .error{
          color: red;
      }
</style>
<script>
  
$( document ).ready(function() {
    
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#department-form").validate({
        // Specify the validation rules
        rules: {
            department_name:"required",
        },
        
        // Specify the validation error messages
        messages: {
            department_name:"Please enter a department name",
        }
        
    });

  });
});
</script>
