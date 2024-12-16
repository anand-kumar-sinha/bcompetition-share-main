<?php
if (isset($MaterialGradeDetail)) {
    $id = $MaterialGradeDetail->id;
    $material_grade_name = $MaterialGradeDetail->material_grade_name;
    $status = $MaterialGradeDetail->status;
    $mode          = 'Edit';
            
} else {
    $id = '';
    $material_grade_name = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/material_grade_master">Material Grade List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Material Grade</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Material Grade</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <form id="materialGrade-form" method="post" action="https://digisysindiatech.com/shivautotech/department_user/material_grade_master/action" enctype="multipart/form-data" novalidate="novalidate">
                            <!-- Start : Company Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <!-- Start ROW -->
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Material Grade Name</label>
                                        <input type="text" class="form-control" id="material_grade_name" name="material_grade_name" value="<?php echo $material_grade_name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="custom-select">
                                            <option value="Active" <?php if($status == 'Active') echo 'selected'; ?>>Active</option>
                                            <option value="Deactive" <?php if($status == 'Deactive') echo 'selected'; ?>>Deactive</option>
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
    $("#materialGrade-form").validate({
        // Specify the validation rules
        rules: {
            material_grade_name:"required",
        },
        
        // Specify the validation error messages
        messages: {
            material_grade_name:"Please enter a material grade name",
        }
        
    });

  });
});
</script>
