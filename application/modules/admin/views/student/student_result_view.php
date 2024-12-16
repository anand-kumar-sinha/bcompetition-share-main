<?php
if (isset($StudentDetail)) {
    $id = $StudentDetail->id;
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
    $profile_pic = $StudentDetail->profile_pic;
    $city_name = $StudentDetail->city_name;
    $wallet_amount = $StudentDetail->wallet_amount;
    $mode          = 'Edit';
    $readonly = "readonly";
} else {
    $id = '';
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
    $profile_pic = '';
    $city_name = '';
    $wallet_amount = '';
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
                    <h4 class="page-title">Student Result</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Student">Student List</a></li>
                        <li class="breadcrumb-item active">Student Result</li>
                    </ol>

                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><?php echo $name;?></h4>
                        <?php if($profile_pic !='') { ?>
                            <img style="max-width: 140px;margin-left: 50px;" class="rounded-circle avatar-xl" alt="200x200" src="<?php echo base_url();?>uploads/student_profile/<?php echo $profile_pic;?>" data-holder-rendered="true">
                        <?php } else { ?>
                            <img style="max-width: 140px;margin-left: 50px;" class="rounded-circle avatar-xl" alt="200x200" src="<?php echo base_url();?>assets/images/default_profile_image.jpg" data-holder-rendered="true">
                        <?php } ?>
                        <div class="mt-4">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Mobile Number</td>
                                        <td class="text-end"><?php echo $mobile_number;?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td class="text-end"><?php echo $city_name;?></td>
                                    </tr>
                                    <tr>
                                        <td>Wallet Balance</td>
                                        <td class="text-end"><?php echo $wallet_amount;?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Exam</td>
                                        <td class="text-end"><?php echo $total_exam;?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Won</td>
                                        <td class="text-end">
                                        <?php 
                                        if($total_won == ''){
                                            echo "0.00";
                                        } else {
                                            echo $total_won;
                                        }
                                        ?>
                                        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Winning Percentage</td>
                                        <td class="text-end"><?php echo $winning_percentage;?>%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#ExamStatics" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Exam Statics</span>    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#RecentlyParticipated" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Recently Participated</span>    
                                </a>
                            </li>
                        </ul>
                 <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="ExamStatics" role="tabpanel">
                                <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                           <th>Percentage</th>
                                           <th>Category Name</th> 
                                           <th>Amount Won</th>
                                           </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ExamStatics as $_ExamStatics) {

                                            ?>
                                            <tr> 
                                                <td><?php echo $_ExamStatics['percentage'].'%'; ?></td>
                                                <td><?php echo $_ExamStatics['category_name']; ?></td>
                                                <td><?php echo $_ExamStatics['total_cash_prize']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane p-3" id="RecentlyParticipated" role="tabpanel">
                                <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                           <th>Test Title</th>
                                           <th>Test Attempt Date</th> 
                                           <th>Amount Won</th>
                                           <th>total_mark</th>
                                           <th>get_mark</th>
                                           <th class="no-sort center-text-table">#</th>
                                           </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($RecentlyParticipated as $_RecentlyParticipated) {

                                            ?>
                                            <tr> 
                                                <td><?php echo $_RecentlyParticipated->test_title; ?></td>
                                                <td><?php echo date("d-m-Y h:i:s A", strtotime($_RecentlyParticipated->created)); ?></td>
                                                <td><?php echo $_RecentlyParticipated->cash_prize; ?></td>
                                                <td><?php echo $_RecentlyParticipated->total_mark; ?></td>
                                                <td><?php echo $_RecentlyParticipated->get_mark; ?></td>
                                                <td>
                                                    <?php echo $_RecentlyParticipated->total_correnct_ans;?> : <b>Correnct</b> &nbsp;&nbsp;&nbsp;
                                                    <?php echo $_RecentlyParticipated->total_wrong_ans;?> : <b>Wrong</b>&nbsp;&nbsp;&nbsp;<br>
                                                    <?php echo $_RecentlyParticipated->total_skipped_ans;?> : <b>Skipped</b>&nbsp;&nbsp;&nbsp;
                                                    <?php echo $_RecentlyParticipated->total_mark_for_review;?> : <b>Mark For Review</b>
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
        </div>

    </div>
    <!-- container-fluid -->

</div>
<!-- content -->

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
</script>