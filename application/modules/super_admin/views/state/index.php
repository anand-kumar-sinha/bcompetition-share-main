<?php
if (isset($StateDetail)) {
    $id = $StateDetail->id;
    $state_name = $StateDetail->state_name;
    $country_id = $StateDetail->country_id;
    $status = $StateDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $state_name = '';
    $country_id = '';
    $status = '';
    $mode      = 'Add';
}
?>

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">State</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>super_admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">State List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="State_Form" method="post" action="<?php echo base_url(); ?>super_admin/State/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtLastNameBilling">Country Name <span class="error">*</span></label>
                                        <select class="custom-select" id="country_id" name="country_id">
                                            <?php foreach ($AllCountry as $_AllCountry) {
                                                    $selected = "";
                                                    if($_AllCountry->id == $country_id){
                                                        $selected = "selected";
                                                    }
                                                ?>
                                            <option value="<?php echo $_AllCountry->id;?>" <?php echo $selected;?>><?php echo $_AllCountry->country_name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">State Name <span class="error">*</span></label>
                                        <input id="state_name" name="state_name" type="text" value="<?php echo $state_name;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtLastNameBilling">Status</label>
                                        <select class="custom-select" id="status" name="status">
                                            <option value="Active" <?php if($status == "Active"){ echo "selected";}?>>Active</option>
                                            <option value="In active" <?php if($status == "In active"){ echo "selected";}?>>In active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-secondary" onclick="CancelData();">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                   <th>Country Name</th>
                                   <th>State Name</th>
                                   <th style="width: 10%;">Status</th>
                                   <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllState as $_AllState) {
                                    if($_AllState->status == "Active"){
                                        $btnClass = "badge-success";
                                    }else{
                                        $btnClass = "badge-danger";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $_AllState->country_name; ?></td>
                                        <td><?php echo $_AllState->state_name; ?></td>
                                        <td><span class="badge <?php echo $btnClass; ?>"><?php echo $_AllState->status; ?></span>
                                            <!--<span class="btn btn-block btn-sm <?php //echo $btnClass; ?>"><?php //echo $_AllState->status; ?></span></td>-->
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'super_admin/State/index?st_id=' . $_AllState->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'super_admin/State/delete/'.$_AllState->id; ?>" onclick="return confirm('Are you sure?');">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container-fluid -->

</div>
<!-- content -->

<script>
    function CancelData() {
        $('#State_Form').trigger("reset");
    }
    
$(document).ready(function() {
    
//        $('.select2').select2();
    $(function() {

        // Setup form validation on the #register-form element
        $("#State_Form").validate({
            // Specify the validation rules
            rules: {
                state_name: "required",
            },

            // Specify the validation error messages
            messages: {
                state_name: "Please enter state name",
            }

        });

    });
});

    
    
</script>