

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Student Rewards Earn </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Student">Student</a></li>
                        <li class="breadcrumb-item active">Student Rewards Earn</li>
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
                                   <th>Refer Student Name</th>
                                   <th>Amount</th>
                                   <th>Created</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllStudentRewardsEarn as $_AllStudentRewardsEarn) {
                                   
                                    ?>
                                    <tr> 
                                        <td><?php echo $_AllStudentRewardsEarn->name; ?></td>
                                        <td><?php echo $_AllStudentRewardsEarn->amount; ?></td>
                                        <td><?php echo date("d-m-Y h:i A", strtotime($_AllStudentRewardsEarn->created)); ?></td>
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
