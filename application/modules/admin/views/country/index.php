<?php
if (isset($CountryDetail)) {
    $id = $CountryDetail->id;
    $country_name = $CountryDetail->country_name;
    $status = $CountryDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $country_name = '';
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
                    <h4 class="page-title">Country</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Country List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Country_Form" method="post" action="<?php echo base_url(); ?>admin/Country/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Country Name <span class="error">*</span></label>
                                        <input id="country_name" name="country_name" type="text" value="<?php echo $country_name;?>" class="form-control">
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
                                <a href="<?php echo base_url();?>admin/Country"><button type="button" class="btn btn-secondary" >Cancel</button></a>
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
                                   <th style="width: 10%;">Status</th>
                                   <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllCountry as $_AllCountry) {
                                    if($_AllCountry->status == "Active"){
                                        $btnClass = "badge-success";
                                    }else{
                                        $btnClass = "badge-danger";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $_AllCountry->country_name; ?></td>
                                        <td><span class="badge <?php echo $btnClass; ?>"><?php echo $_AllCountry->status; ?></span>
                                            <!--<span class="btn btn-block btn-sm <?php //echo $btnClass; ?>"><?php //echo $_AllCountry->status; ?></span></td>-->
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'admin/Country/index?c_id=' . $_AllCountry->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'admin/Country/delete/'.$_AllCountry->id; ?>" onclick="return confirm('Are you sure?');">
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
        $('#Country_Form').trigger("reset");
    }
    
    $(document).ready(function() {
//        $('.select2').select2();
        $(function() {

            // Setup form validation on the #register-form element
            $("#Country_Form").validate({
                // Specify the validation rules
                rules: {
                    country_name: "required",
                },

                // Specify the validation error messages
                messages: {
                    country_name: "Please enter country name",
                }

            });

        });
    });

    
    
</script>