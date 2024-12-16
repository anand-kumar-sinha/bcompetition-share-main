

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Manage Student Group</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Student Group</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Company_detail_Form" method="post" action="<?php echo base_url(); ?>admin/Student/actionSaveGroup" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="1">
                             <p style="font-size: 17px;"><strong>Member Student Group</strong></p>
                            <div class="row">
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level1 Group</label>
                                        <input id="student_first_group_member" name="student_first_group_member" type="number" value="<?php echo $earn_data->student_first_group_member;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level1 Group Amount</label>
                                        <input id="student_first_group_member_amount" name="student_first_group_member_amount" type="number" value="<?php echo $earn_data->student_first_group_member_amount;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level2 Group</label>
                                        <input id="student_second_group_member" name="student_second_group_member" type="number" value="<?php echo $earn_data->student_second_group_member;?>" class="form-control">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level2 Group Amount</label>
                                        <input id="student_second_group_member_amount" name="student_second_group_member_amount" type="number" value="<?php echo $earn_data->student_second_group_member_amount;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level3 Group</label>
                                        <input id="student_third_group_member" name="student_third_group_member" type="number" value="<?php echo $earn_data->student_third_group_member;?>" class="form-control">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level3 Group Amount</label>
                                        <input id="student_third_group_member_amount" name="student_third_group_member_amount" type="number" value="<?php echo $earn_data->student_third_group_member_amount;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level4 Group</label>
                                        <input id="student_fourth_group_member" name="student_fourth_group_member" type="number" value="<?php echo $earn_data->student_fourth_group_member;?>" class="form-control">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level4 Group Amount</label>
                                        <input id="student_fourth_group_member_amount" name="student_fourth_group_member_amount" type="number" value="<?php echo $earn_data->student_fourth_group_member_amount;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level5 Group</label>
                                        <input id="student_fifth_group_member" name="student_fifth_group_member" type="number" value="<?php echo $earn_data->student_fifth_group_member;?>" class="form-control">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level5 Group Amount</label>
                                        <input id="student_fifth_group_member_amount" name="student_fifth_group_member_amount" type="number" value="<?php echo $earn_data->student_fifth_group_member_amount;?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        
                           

                           
                            <div class="box-footer">
                                <a href="<?php echo base_url();?>admin/Refer_earn_level"><button type="button" class="btn btn-secondary">Cancel</button></a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->

</div>
<!-- content -->


    