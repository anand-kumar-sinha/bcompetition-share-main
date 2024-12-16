<?php
if (isset($storeDetail)) {
    $id = $storeDetail->id;
    $qty = $storeDetail->qty;
    $material_description = $storeDetail->material_description;
    $unit = $storeDetail->unit;
    $rate = $storeDetail->rate;
    $amount = $storeDetail->amount;
    $remark = $storeDetail->remark;
    $mode          = 'Edit';            
} else {
    $id = '';
    $qty = '';
    $material_description = '';
    $unit = '';
    $rate = '';
    $amount = '';
    $remark = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Store_master">Store List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Client</li>
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
                            <h3 class="card-title">Add Store</h3>
                        </div>
                        <div class="card-body">
                            <form id="client-form" method="post" action="https://digisysindiatech.com/shivautotech/admin/Store_master/action" enctype="multipart/form-data" novalidate="novalidate">
                            <!-- Start : Company Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <!-- Start ROW -->
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Material Description</label>
                                        <input type="text" class="form-control" id="material_description" name="material_description" value="<?php echo $material_description; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="text" class="form-control" id="qty" name="qty" value="<?php echo $qty; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select name="unit" class="custom-select">
                                            <option value="KG" <?php if($unit == 'KG') echo 'selected'; ?>>KG</option>
                                            <option value="Liter" <?php if($unit == 'Liter') echo 'selected'; ?>>Liter</option>
                                            <option value="Meter" <?php if($unit == 'Meter') echo 'selected'; ?>>Meter</option>
                                            <option value="Pcs" <?php if($unit == 'Pcs') echo 'selected'; ?>>Pcs</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End ROW -->
                            <!-- Start ROW -->
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Rate</label>
                                        <input type="text" class="form-control" id="rate" name="rate" value="<?php echo $rate; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $amount; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Remark</label>
                                        <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $remark; ?>">
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
            material_description:"required",
            qty:"required",
            unit:"required",
            rate:"required",
            amount:"required"
        },
        
        // Specify the validation error messages
        messages: {
            material_description:"Please enter a material description",
            qty:"Please enter a qty",
            unit:"Please select unit",
            rate:"Please enter rate",
            amount:"Please enter amount",
        }
        
    });

  });
});
</script>
