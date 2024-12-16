<?php
if (isset($customerDetail)) {
    $id = $customerDetail->id;
    $customer_name = $customerDetail->customer_name;
    $customer_code = $customerDetail->customer_code;
    $contact = $customerDetail->contact;
    $address = $customerDetail->address;
    $gst = $customerDetail->gst;
    $pan_number = $customerDetail->pan_number;
    $email = $customerDetail->email;
    $status = $customerDetail->status;
    $proprietor_partnership = $customerDetail->proprietor_partnership;
    $mode          = 'Edit';            
} else {
    $id = '';
    $customer_name = '';
    $customer_code = '';
    $contact = '';
    $address = '';
    $gst = '';
    $pan_number = '';
    $email = '';
    $status = '';
    $proprietor_partnership = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Customer_master">Customer List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Customer</li>
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
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Customer</h3>
                        </div>
                        <div class="card-body">
                            <form id="client-form" method="post" action="<?php echo base_url();?>department_user/Customer_master/action" enctype="multipart/form-data" novalidate="novalidate">
                            <!-- Start : Company Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <!-- Start ROW -->
                            <div class="row">
<!--                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Customer Code</label>
                                        <input type="text" class="form-control" id="customer_code" name="customer_code" value="<?php //echo $customer_code; ?>" readonly="">
                                    </div>
                                </div>-->
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Contact</label>
                                        <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- End ROW -->
                            <!-- Start ROW -->
                            <div class="row">
                                <div class="col-md-3"> 
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3"> 
                                    <div class="form-group">
                                        <label>GST</label>
                                        <input type="text" class="form-control" id="gst" name="gst" value="<?php echo $gst; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3"> 
                                    <div class="form-group">
                                        <label>Pan Number</label>
                                        <input type="text" class="form-control" id="pan_number" name="pan_number" value="<?php echo $pan_number; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3"> 
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- End ROW -->
                            <!-- Start ROW -->
                            <div class="row">
                                <div class="col-md-3"> 
                                    <div class="form-group"> 
                                        <label>Proprietor / Partnership</label>
                                        <select name="proprietor_partnership" class="custom-select">
                                            <option value="Proprietor" <?php if($proprietor_partnership == "Proprietor") echo 'selected'; ?>>Proprietor</option>
                                            <option value="Partnership" <?php if($proprietor_partnership == "Partnership") echo 'selected'; ?>>Partnership Firm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="custom-select">
                                            <option value="Active" <?php if($status == "Active") echo 'selected'; ?>>Active</option>
                                            <option value="Deactive" <?php if($status == "Deactive") echo 'selected'; ?>>Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End ROW -->
                            <!-- End : Company Details -->
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
    $("#client-form").validate({
        // Specify the validation rules
        rules: {
            customer_name:"required",
//            customer_code:"required",
           contact: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
            },
            pan_number:"required",
            email:"required"
        },
        
        // Specify the validation error messages
        messages: {
            customer_name:"Please enter name",
//            customer_code:"Please enter code",
            contact: {
                required: "Enter Contact Number",
                number: "Enter only number",
                maxlength: "Please enter maximum 10 latters in Number",
                minlength: "Please enter minimum 10 latters in Number",
            },
            pan_number:"Please enter pan number",
            email:"Please enter email",
        }
        
    });

  });
});
</script>
