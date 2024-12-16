<?php
if (isset($CityDetail)) {
    $id = $CityDetail->id;
    $city_name = $CityDetail->city_name;
    $country_id = $CityDetail->country_id;
    $state_id = $CityDetail->state_id;
    $status = $CityDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $city_name = '';
    $country_id = '';
    $state_id = '';
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
                    <h4 class="page-title">City</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">City List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="City_Form" method="post" action="<?php echo base_url(); ?>admin/City/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtLastNameBilling">Country Name <span class="error">*</span></label>
                                        <select class="custom-select" id="country_id" name="country_id" onchange="GetState(this.value);">
                                            <option value="">-- Select -- </option>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtLastNameBilling">State Name <span class="error">*</span></label>
                                        <select class="custom-select" id="state_id" name="state_id">
                                            <option value="">-- Select -- </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">City Name <span class="error">*</span></label>
                                        <input id="city_name" name="city_name" type="text" value="<?php echo $city_name;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
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
                                <a href="<?php echo base_url();?>admin/City"><button type="button" class="btn btn-secondary">Cancel</button></a>
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
                                   <th>City Name</th>
                                   <th style="width: 10%;">Status</th>
                                   <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllCity as $_AllCity) {
                                    if($_AllCity->status == "Active"){
                                        $btnClass = "badge-success";
                                    }else{
                                        $btnClass = "badge-danger";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $_AllCity->country_name; ?></td>
                                        <td><?php echo $_AllCity->state_name; ?></td>
                                        <td><?php echo $_AllCity->city_name; ?></td>
                                        <td><span class="badge <?php echo $btnClass; ?>"><?php echo $_AllCity->status; ?></span>
                                            <!--<span class="btn btn-block btn-sm <?php //echo $btnClass; ?>"><?php //echo $_AllCity->status; ?></span></td>-->
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'admin/City/index?ct_id=' . $_AllCity->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'admin/City/delete/'.$_AllCity->id; ?>" onclick="return confirm('Are you sure?');">
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
    
    
$(document).ready(function() {
    
//        $('.select2').select2();
    $(function() {

        // Setup form validation on the #register-form element
        $("#City_Form").validate({
            // Specify the validation rules
            rules: {
                city_name: "required",
                state_id: "required",
                country_id: "required",
            },

            // Specify the validation error messages
            messages: {
                city_name: "Please enter city name",
                country_id: "Select country",
                state_id: "Select state",
            }

        });

    });
});
    
    GetState('<?php echo $country_id;?>');
function GetState(country_id) {
    var  state_id = '<?php echo $state_id;?>';
     $.ajax({  
            url:"<?php echo base_url() . "admin/City/get_state_list"; ?>",  
            method:"POST",  
            data:{country_id:country_id, state_id:state_id},  
            success:function(data)  
            {  
                $('#state_id').html(data);  
            }  
       });
}
function CancelData() {
    $('#City_Form').trigger("reset");
}
</script>