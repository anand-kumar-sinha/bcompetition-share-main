<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Test Subscription List</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Test Subscription List</li>
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
                                   <th>No</th>
                                   <th>Profile Image</th>
                                   <th>Name</th>
                                   <th>Mobile No</th>
                                   <th>Test Name</th>
                                   <th>Subscription Amount</th>
                                   <th>Payment Mode</th>
                                   <th>Subscription Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $UniqueI=0; foreach ($TestSubscriptionAll as $_TestSubscriptionAll) { $UniqueI++;?>
                                    <tr>
                                        <td><?php echo $UniqueI; ?></td> 
                                        <td>
                                            <?php if($_TestSubscriptionAll->profile_pic !='') { ?>
                                            <img src="<?php echo base_url();?>uploads/student_profile/<?php echo $_TestSubscriptionAll->profile_pic; ?>" width="150px;">
                                            <?php } ?>
                                        </td> 
                                        <td><?php echo $_TestSubscriptionAll->student_name; ?></td> 
                                        <td><?php echo $_TestSubscriptionAll->mobile_number; ?></td> 
                                        <td><?php echo $_TestSubscriptionAll->test_title; ?></td> 
                                        <td><?php echo $_TestSubscriptionAll->join_amount; ?></td> 
                                        <td><?php echo $_TestSubscriptionAll->payment_type; ?></td> 
                                        <td><?php echo date("d-m-Y", strtotime($_TestSubscriptionAll->created)); ?></td> 
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
        $('#Category_Form').trigger("reset");
    }
    
    $(document).ready(function() {
//        $('.select2').select2();
        $(function() {

            // Setup form validation on the #register-form element
            $("#Category_Form").validate({
                // Specify the validation rules
                rules: {
                    category_name: "required",
                },

                // Specify the validation error messages
                messages: {
                    category_name: "Please enter category name",
                }

            });

        });
    });

    
    
</script>