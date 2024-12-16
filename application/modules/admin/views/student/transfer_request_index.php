
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Student </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Student">Student List</a></li>
                        <li class="breadcrumb-item active">Transfer Request List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                   <th>Name</th>
                                   <th>Mobile Number</th>
                                   <th>Bank Detail</th>
                                   <th>Date Of Birth</th>
                                   <th>Request Date</th>
                                   <th>Request Amount</th>
                                   <th>Wallet Amount</th>
                                   <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllStudent as $_AllStudent) {
                                   
                                    ?>
                                    <tr>
                                        <td><?php echo $_AllStudent->name; ?></td>
                                        <td><?php echo $_AllStudent->mobile_number; ?></td>
                                        <td><?php echo $_AllStudent->bank_detail; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($_AllStudent->date_of_birth)); ?></td>
                                        <td><?php echo date("d-m-Y h:i A", strtotime($_AllStudent->created)); ?></td>
                                        <td><?php echo $_AllStudent->amount; ?></td>
                                        <td><?php echo $_AllStudent->wallet_amount; ?></td>
                                        <td class="no-sort center-text-table">
                                            <?php if($_AllStudent->wallet_amount >= $_AllStudent->amount){ ?>
                                             <a href="<?php echo base_url().'admin/Student/approve_transfer_request/'.$_AllStudent->id; ?>"  onclick="return confirm('Are you sure Approve Request?');">
                                                <button class="btn btn-info btn-sm">Approve Request</button>
                                            </a>
                                            <?php }?>
                                           
                                              <a href="<?php echo base_url().'admin/Student/delete_transfer_requrest/'.$_AllStudent->id; ?>"  onclick="return confirm('Are you sure Delete Request?');">
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