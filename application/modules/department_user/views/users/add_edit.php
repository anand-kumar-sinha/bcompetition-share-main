<?php
if (isset($UserDetail)) {
    $id            = $UserDetail->id;
    $name           = $UserDetail->name;
    $email            = $UserDetail->email;
    $contact    = $UserDetail->contact;
    $mode          = 'Edit';
     
           
            
} else {
    $id        = '';
    $name        = '';
    $email       = '';
    $contact    = '';
    $username     = '';
    $password     = '';
    $mode      = 'Add';
}
?>  
<section class="content-header">
    <small>&nbsp;</small>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>admin/Users">Student</a></li>
        <li class="active"><?php echo $mode; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $mode; ?> Student</h3>
                </div>
                <form id="student-form" method="post" action="<?php echo base_url() ?>admin/Users/action" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                    <div class="box-body">
                       
                        <!-- Start ROW -->
                        <div class="row">
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" >
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" >
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>" >
                                </div>
                            </div>
                        </div>
                        <!-- End ROW -->
                        <!-- Start ROW -->
                        <?php if($mode == "Add") {?>
                        <div class="row">
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" >
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" >
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- End ROW -->
                    </div>
                    <div class="box-footer">
                            <a href="<?php echo base_url() . 'admin/Users/' ?>"><button type="button" class="btn btn-defalt">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
</section>



<style>
      .error{
          color: red;
      }
</style>
<script>
$( document ).ready(function() {
    
    $(function() {
  
    // Setup form validation on the #register-form element
    $("#student-form").validate({
        // Specify the validation rules
        rules: {
            name:"required",
            email:"required",
            username:"required",
            password:"required",
            
            contact: {
                required: true,
                number:true,
                minlength:10,
                maxlength:10
            }
            
        },
        
        // Specify the validation error messages
        messages: {
            name:"Please enter a Name",
            email:"Please enter a E-mail",
            username:"Please enter a Username",
            password:"Please enter a Password",
           
            contact: {
                required: "Enter a Contact No ",
                numeric: "Please enter numeric values only",
                minlength:"Your contact number must be 10 characters long",
                maxlength:"Your contact number must be 10 characters long"
            }
        }
        
    });

  });
});

</script>