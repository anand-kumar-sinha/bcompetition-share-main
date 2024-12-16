

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Manage Refer Earn Level</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Refer Earn Level</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Company_detail_Form" method="post" action="<?php echo base_url(); ?>admin/Refer_earn_level/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="1">
                             <p style="font-size: 17px;"><strong>Member Amount</strong></p>
                            <div class="row">
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level1</label>
                                        <input id="member_level1" name="member_level1" type="number" value="<?php echo $earn_data->member_level1;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level2</label>
                                        <input id="member_level2" name="member_level2" type="number" value="<?php echo $earn_data->member_level2;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level3</label>
                                        <input id="member_level3" name="member_level3" type="number" value="<?php echo $earn_data->member_level3;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level4</label>
                                        <input id="member_level4" name="member_level4" type="number" value="<?php echo $earn_data->member_level4;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level5</label>
                                        <input id="member_level5" name="member_level5" type="number" value="<?php echo $earn_data->member_level5;?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        
                             <p style="font-size: 17px;"><strong>Course Active(%)</strong></p>
                            <div class="row">
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level1</label>
                                        <input id="course_level1" name="course_level1" type="number" value="<?php echo $earn_data->course_level1;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level2</label>
                                        <input id="course_level2" name="course_level2" type="number" value="<?php echo $earn_data->course_level2;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level3</label>
                                        <input id="course_level3" name="course_level3" type="number" value="<?php echo $earn_data->course_level3;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level4</label>
                                        <input id="course_level4" name="course_level4" type="number" value="<?php echo $earn_data->course_level4;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level5</label>
                                        <input id="course_level5" name="course_level5" type="number" value="<?php echo $earn_data->course_level5;?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                             <p style="font-size: 17px;"><strong>Test Active(%)</strong></p>
                            <div class="row">
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level1</label>
                                        <input id="test_active_level1" name="test_active_level1" type="number" value="<?php echo $earn_data->test_active_level1;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level2</label>
                                        <input id="test_active_level2" name="test_active_level2" type="number" value="<?php echo $earn_data->test_active_level2;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level3</label>
                                        <input id="test_active_level3" name="test_active_level3" type="number" value="<?php echo $earn_data->test_active_level3;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level4</label>
                                        <input id="test_active_level4" name="test_active_level4" type="number" value="<?php echo $earn_data->test_active_level4;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level5</label>
                                        <input id="test_active_level5" name="test_active_level5" type="number" value="<?php echo $earn_data->test_active_level5;?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                                 <p style="font-size: 17px;"><strong>Test Submit(%)</strong></p>
                            <div class="row">
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level1</label>
                                        <input id="test_submit_level1" name="test_submit_level1" type="number" value="<?php echo $earn_data->test_submit_level1;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level2</label>
                                        <input id="test_submit_level2" name="test_submit_level2" type="number" value="<?php echo $earn_data->test_submit_level2;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level3</label>
                                        <input id="test_submit_level3" name="test_submit_level3" type="number" value="<?php echo $earn_data->test_submit_level3;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level4</label>
                                        <input id="test_submit_level4" name="test_submit_level4" type="number" value="<?php echo $earn_data->test_submit_level4;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level5</label>
                                        <input id="test_submit_level5" name="test_submit_level5" type="number" value="<?php echo $earn_data->test_submit_level5;?>" class="form-control">
                                    </div>
                                </div>
                            </div>


                               <p style="font-size: 17px;"><strong>Package(%)</strong></p>
                            <div class="row">
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level1</label>
                                        <input id="test_submit_level1" name="package_level1" type="number" value="<?php echo $earn_data->package_level1;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level2</label>
                                        <input id="test_submit_level2" name="package_level2" type="number" value="<?php echo $earn_data->package_level2;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level3</label>
                                        <input id="test_submit_level3" name="package_level3" type="number" value="<?php echo $earn_data->package_level3;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level4</label>
                                        <input id="test_submit_level4" name="package_level4" type="number" value="<?php echo $earn_data->package_level4;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level5</label>
                                        <input id="test_submit_level5" name="package_level5" type="number" value="<?php echo $earn_data->package_level5;?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                               <p style="font-size: 17px;"><strong>Auto Pool(%)</strong></p>
                            <div class="row">
                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level1</label>
                                        <input id="test_submit_level1" name="adpackageactive1"  type="number" value="<?php echo $earn_data->adpackageactive1;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level2</label>
                                        <input id="test_submit_level2" name="adpackageactive2"  type="number" value="<?php echo $earn_data->adpackageactive2;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level3</label>
                                        <input id="test_submit_level3" name="adpackageactive3"  type="number" value="<?php echo $earn_data->adpackageactive3;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level4</label>
                                        <input id="test_submit_level4" name="adpackageactive4"  type="number" value="<?php echo $earn_data->adpackageactive4;?>" class="form-control">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Level5</label>
                                        <input id="test_submit_level5" name="adpackageactive5"  type="number" value="<?php echo $earn_data->adpackageactive5;?>" class="form-control">
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


    