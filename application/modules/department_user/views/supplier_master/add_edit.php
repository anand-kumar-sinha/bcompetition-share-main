<?php
if (isset($AllSupplier)) {
    $id = $AllSupplier->id;
    $supplier_name = $AllSupplier->supplier_name;
    $supplier_code = $AllSupplier->supplier_code;
    $contact = $AllSupplier->contact;
    $address = $AllSupplier->address;
    $gst = $AllSupplier->gst;
    $pan_number = $AllSupplier->pan_number;
    $email = $AllSupplier->email;
    $proprietor_partnership = $AllSupplier->proprietor_partnership;
    $status = $AllSupplier->status;
    $mode          = 'Edit';
            
} else {
    $id = '';
    $supplier_name = '';
    $supplier_code = '';
    $contact = '';
    $address = '';
    $gst = '';
    $pan_number = '';
    $email = '';
    $proprietor_partnership = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Supplier_master">Supplier List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Supplier</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Supplier</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <form id="client-form" method="post" action="<?php echo base_url();?>department_user/Supplier_master/action" enctype="multipart/form-data" novalidate="novalidate">
                            <!-- Start : Company Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <!-- Start ROW -->
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Supplier/Billing Party Name</label>
                                        <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="<?php echo $supplier_name; ?>">
                                    </div>
                                </div>
<!--                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Supplier Code</label>
                                        <input type="text" class="form-control" id="supplier_code" name="supplier_code" value="<?php //echo $supplier_code; ?>">
                                    </div>
                                </div>-->
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Contact</label>
                                        <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>">
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
                                        <label>Proprietor / Partnership</label>
                                        <select name="proprietor_partnership" class="custom-select">
                                            <option value="Proprietor" <?php if($proprietor_partnership == "Proprietor") echo 'selected'; ?>>Proprietor</option>
                                            <option value="Partnership" <?php if($proprietor_partnership == "Partnership") echo 'selected'; ?>>Partnership Firm</option>
                                        </select>
                                    </div>
                                </div>
                               
                            </div>
                            <!-- End ROW -->
                            <!-- Start ROW -->
                            <div class="row">
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
            supplier_name:"required",
//            supplier_code:"required",
            contact: {
                       required: true,
                       number: true,
                       minlength: 10,
                       maxlength: 10,
                   },
            address:"required",
            email:"required",
        },
        
        // Specify the validation error messages
        messages: {
            supplier_name:"Please enter a supplier name",
//            supplier_code:"Please enter a supplier code",
            contact: {
                      required: "Enter Contact Number",
                      number: "Enter only number",
                      maxlength: "Please enter maximum 10 latters in Number",
                      minlength: "Please enter minimum 10 latters in Number",
                  },
            address:"Please enter address",
            email:"Please enter email",
            
        }
        
    });

  });
});
</script>
