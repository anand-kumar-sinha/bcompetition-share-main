<?php
if (isset($StudentDetail)) {
    $id = $StudentDetail->id;
    $school_name = $StudentDetail->school_name;
    $name = $StudentDetail->name;
    $email = $StudentDetail->email;
    $date_of_birth = date("d-m-Y", strtotime($StudentDetail->date_of_birth));
    $gender = $StudentDetail->gender;
    $mobile_number = $StudentDetail->mobile_number;
    $address = $StudentDetail->address;
    $country_id = $StudentDetail->country_id;
    $state_id = $StudentDetail->state_id;
    $city_id = $StudentDetail->city_id;
    $pin_code = $StudentDetail->pin_code;
     $refer_code = $StudentDetail->referral_code;
    $mode          = 'Edit';
    $readonly = "readonly";
} else {
    $id = '';
    $school_name = '';
    $name = '';
    $email = '';
    $date_of_birth = '';
    $gender = '';
    $mobile_number = '';
    $address = '';
    $country_id = '';
    $state_id = '';
    $city_id = '';
    $pin_code = '';
    $refer_code = '';
    $mode      = 'Add';
    $readonly = "";
}
?>

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Student </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Student List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Student_Form" method="post" action="<?php echo base_url(); ?>admin/Student/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
							
							<div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">School / Collage Name<span class="error">*</span></label>
                                        <input id="school_name" name="school_name" type="text" value="<?php echo $school_name;?>" class="form-control">
                                    </div>
                                </div>
							</div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> Name<span class="error">*</span></label>
                                        <input id="name" name="name" type="text" value="<?php echo $name;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> E-mail<span class="error">*</span></label>
                                        <input id="email" name="email" type="email" value="<?php echo $email;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> Date Of Birth<span class="error">*</span></label>
                                        <input id="date_of_birth" name="date_of_birth" type="text" value="<?php echo $date_of_birth;?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> Gender<span class="error">*</span></label><br>
                                        <input id="Male" name="gender" type="radio" value="Male" class="" <?php if($gender == "Male"){ echo "checked";}?>>&nbsp;&nbsp; <label for="Male">Male</label> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input id="Female" name="gender" type="radio" value="Female" class=""  <?php if($gender == "Female"){ echo "checked";}?>>&nbsp;&nbsp; <label for="Female">Female </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Mobile Number<span class="error">*</span></label>
                                        <input id="mobile_number" name="mobile_number" type="text" value="<?php echo $mobile_number;?>" class="form-control" onblur="UniqueStudent(this.value);" <?php echo $readonly;?>>
                                        <div id="MobileMessage"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Address<span class="error">*</span></label>
                                        <input id="address" name="address" type="text" value="<?php echo $address;?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> Country<span class="error">*</span></label>
                                        <select name="country_id" id="country_id" class="custom-select select2" onchange="GetState(this.value);">
                                            <option value="">-- Select Country --</option>
                                            <?php foreach ($AllCountry as $_AllCountry) { 
                                                    $selected = "";
                                                    if($country_id == $_AllCountry->id){
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                <option value="<?php echo $_AllCountry->id; ?>" <?php echo $selected;?>><?php echo $_AllCountry->country_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> State<span class="error">*</span></label>
                                        <select name="state_id" id="state_id" class="custom-select select2"  onchange="GetCity(this.value);">
                                            <option value="">-- Select State --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> City<span class="error">*</span></label>
                                        <select name="city_id" id="city_id" class="custom-select select2">
                                            <option value="">-- Select City --</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> Pin Code<span class="error">*</span></label>
                                        <input id="pin_code" name="pin_code" type="text" value="<?php echo $pin_code;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> Referral Code<span class="error">*</span></label>
                                        <input id="pin_code" onchange="checkrefercode(this.value);" name="refer_code" type="text" value="<?php echo $refer_code;?>" class="form-control" <?php echo $readonly;?>>
                                         <div id="ReferMessage"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="<?php echo base_url();?>admin/Student"><button type="button" class="btn btn-secondary">Cancel</button></a>
                                <button id="SubmitBtn" type="submit" class="btn btn-primary">Save</button>
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
                                   <th>Name</th>
                                   <th>E-mail</th>
<!--                                   <th>Date Of Birth</th>
                                   <th>Gender</th>-->
                                   <th>Mo Number / Ref Code</th>
                                   <th>City</th>
                                   <th>Subscribe Test</th>
                                   <th style="width: 10%;">Wallet Amount</th>
                                   <th style="width: 10%;">Rewards Earn</th>
                                   <th class="no-sort center-text-table" style="width: 15%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllStudent as $_AllStudent) {
                                   
                                    ?>
                                    <tr> 
                                        <td><?php echo $_AllStudent->name; ?></td>
                                        <td><?php echo $_AllStudent->email; ?></td>
                                        <!--<td><?php // echo date("d-m-Y", strtotime($_AllStudent->date_of_birth)); ?></td>-->
                                        <!--<td><?php // echo $_AllStudent->gender; ?></td>-->
                                        <td><?php echo $_AllStudent->mobile_number. ' / '. $_AllStudent->referral_code; ?></td>
                                        <td><?php echo $_AllStudent->city_name; ?></td>
                                        <td class="custom_ul">
                                            <ul>
                                            <?php foreach ($_AllStudent->student_test_subscribe as $_student_test_subscribe) { ?>
                                                <li style="list-style-type: none;"><span class="badge bg-success" style="color: #fff;font-size: 14px;"><?php echo $_student_test_subscribe->test_title;?></span></li>
                                            <?php } ?>
                                            </ul>
                                        </td>
                                        <td><?php echo $_AllStudent->wallet_amount; ?></td>
                                        <td>
                                            <?php 
                                            if($_AllStudent->total_earn == ''){
                                                    echo "0.00";
                                            } else {
                                                echo $_AllStudent->total_earn; 
                                            }
                                            ?>
                                        
                                        </td>
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'admin/Student/index?c_id=' . $_AllStudent->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'admin/Student/delete/'.$_AllStudent->id; ?>" onclick="return confirm('Are you sure?');">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </a>
                                            <a href="<?php echo base_url().'admin/Student/wallet_history_index/'.$_AllStudent->id; ?>">
                                                <button style="margin: 3px 0px;" class="btn btn-info btn-sm">Wallet History</button>
                                            </a><br>
                                            <a href="<?php echo base_url().'admin/Student/rewards_earn_index/'.$_AllStudent->id; ?>">
                                                <button style="margin: 3px 0px;"  class="btn btn-info btn-sm">Rewards Earn</button>
                                            </a>
                                            <a href="<?php echo base_url().'admin/Student/student_result_view/'.$_AllStudent->id; ?>">
                                                <button style="margin: 3px 0px;"  class="btn btn-info btn-sm">View Result</button>
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
<style>
.custom_ul ul {
  columns: 2;
  -webkit-columns: 2;
  -moz-columns: 2;
}
</style>
<script>
    $(".select2").select2();
     $('#date_of_birth').datepicker({
        format: "dd-mm-yyyy",
        todayHighlight: true,
        autoclose: true,
    });
    
    $(document).ready(function() {
        GetState('<?php echo $country_id; ?>');
        GetCity('<?php echo $state_id; ?>');
    });
    function CancelData() {
        $('#Student_Form').trigger("reset");
    }
    
    $(document).ready(function() {
//        $('.select2').select2();
        $(function() {

            // Setup form validation on the #register-form element
            $("#Student_Form").validate({
                // Specify the validation rules
                rules: {
                    name: "required",
                    email: "required",
                    date_of_birth: "required",
                    gender: "required",
                    address: "required",
                    country_id: "required",
                    state_id: "required",
                    city_id: "required",
                    pin_code: "required",
                    mobile_number: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                    },  
                },

                // Specify the validation error messages
                messages: {
                    name: "Please enter name",
                    email: "Please enter email",
                    date_of_birth: "Please enter date of birth",
                    gender: "Please select gender",
                    address: "Please enter address",
                    country_id: "Please select country",
                    state_id: "Please select state",
                    city_id: "Please select city",
                    pin_code: "Please enter pin code",
                    mobile_number: {
                        required: "Enter Mobile No",
                        number: "Enter only number",
                        maxlength: "Please enter maximum 10 latters in Number",
                        minlength: "Please enter minimum 10 latters in Number",
                    },
                }

            });

        });
    });

    
    
    function GetState(country_id){
        var state_id = '<?php echo $state_id;?>';
        $.ajax({  
            url:"<?php echo base_url() . "admin/Student/get_state_list"; ?>",  
            method:"POST",  
            data:{country_id:country_id, state_id:state_id},  
            success:function(data)  
            {  
                $('#state_id').html(data);  
            }  
       });
    }
    function GetCity(state_id){
        var city_id = '<?php echo $city_id;?>';
        $.ajax({  
            url:"<?php echo base_url() . "admin/Student/get_city_list"; ?>",  
            method:"POST",  
            data:{state_id:state_id, city_id:city_id},  
            success:function(data)  
            {  
                $('#city_id').html(data);  
            }  
       });
    }
    function UniqueStudent(mobile_number){
        $.ajax({  
            url:"<?php echo base_url() . "admin/Student/unique_student"; ?>",  
            method:"POST",  
            data:{mobile_number:mobile_number},  
            success:function(data)  
            {  
                if(data == 0){
                    $("#MobileMessage").html('<span style="color:green;"> Unique Student</span>');
                    $("#SubmitBtn").show();
                } else {
                    $("#MobileMessage").html('<span style="color:red;"> Enter Unique Mobile Number</span>');
                    $("#SubmitBtn").hide();
                }
            }  
       });
    }

        function checkrefercode(mobile_number){
        $.ajax({  
            url:"<?php echo base_url() . "admin/Student/checkrefercodeinfo"; ?>",  
            method:"POST",  
            data:{mobile_number:mobile_number},  
            success:function(data)  
            {  
                if(data == 0){
                    $("#ReferMessage").html('');
                    $("#SubmitBtn").show();
                } else {
                    $("#ReferMessage").html('<span style="color:red;"> Refercode is not valid</span>');
                    $("#SubmitBtn").hide();
                }
            }  
       });
    }
</script>
