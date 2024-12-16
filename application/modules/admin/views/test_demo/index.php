<?php
if (isset($CategoryDetail)) {
    $id = $CategoryDetail->id;
    $category_name = $CategoryDetail->category_name;
    $status = $CategoryDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $category_name = '';
    $status = '';
    $mode      = 'Add';
}
?>

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-10">
                    <h4 class="page-title">Test</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Test List</li>
                    </ol>

                </div>
                <div class="col-sm-2">
                    <a href="<?php echo base_url();?>admin/Test/add_edit" class="btn btn-success btn-sm" style="background-color: #2182CF; border-color: #2182CF;"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Create New Test&nbsp;&nbsp;&nbsp;</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-toggle="tab" href="#OnGoing" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">On-Going</span> 
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#UpComing" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Up-Coming</span> 
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#Created" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Created</span>   
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#Deleted" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Deleted</span>    
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#UnPublished" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Un-Published</span>    
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="OnGoing" role="tabpanel">
                                <?php foreach ($AllPublishOnGoingTest as $_AllPublishOnGoingTest) { ?>
                                <div class="card col-sm-12" style="padding-left:0px; padding-right:0px; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)">
                                    <div class="card-header" style="padding: .5rem .8rem;">
                                        <div class="float-left" style="margin-top:8px"><b><i><?php echo $_AllPublishOnGoingTest->test_title;?></i></b> </div>
                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light float-right"><?php echo $_AllPublishOnGoingTest->category_name;?></button>
                                    </div>
                                    <div class="card-body" id="33_data" data-name="Demo Test" data-auto-unpublish="yes" data-attempts="0" data-published="yes" data-publish-date="2021-10-12 08:15:49" data-unpublish-date="2021-04-13 09:19:00" data-test-type="free">
                                        <p>Test Type: <b><?php echo $_AllPublishOnGoingTest->test_type;?></b><br>
                                            Created by:  Admin<br>
                                            Questions: <?php echo $_AllPublishOnGoingTest->TotalQuestion;?><br><br>
                                        </p>
                                            Current Status: <?php echo $_AllPublishOnGoingTest->status;?>

                                        <button type="button" onclick="editTest(<?php echo $_AllPublishOnGoingTest->id;?>)" class="btn btn-warning waves-effect waves-light float-right" style="margin-left: 5px;"><i class="mdi mdi-pencil"></i> Edit</button>
                                        <button type="button" onclick="unpublishTest(<?php echo $_AllPublishOnGoingTest->id;?>)" class="btn btn-secondary waves-effect waves-light float-right"><i class="mdi mdi-close"></i> Unpublish/Close Test</button>
                                        <!-- <button type="button" onclick='showResult("5fc729206dcd4c65719cef5b")' style="margin-right: 5px;" class="btn btn-success waves-effect waves-light float-right"><i class="mdi mdi-format-page-break"></i> Result</button> -->
                                        <button type="button" onclick="previewTest(74)" style="margin-right: 5px;" class="btn btn-primary waves-effect waves-light float-right"><i class="mdi mdi-eye"></i> Preview Test</button>
                                        <?php if($_AllPublishOnGoingTest->winer_list_publish == "false" && $_AllPublishOnGoingTest->result_publish == "true") { ?>
                                        <a href="<?php echo base_url();?>admin/Test_demo/winer_list/<?php echo $_AllPublishOnGoingTest->test_id;?>_<?php echo $_AllPublishOnGoingTest->category_id;?>_<?php echo $_AllPublishOnGoingTest->id;?>">
                                        <button type="button" class="btn btn-info waves-effect waves-light float-right" style="margin-left: 5px;margin-right: 5px;">Winer List</button>
                                        </a>
                                        <?php } ?>
                                        <?php if($_AllPublishOnGoingTest->result_publish == "false") { ?>
                                        <a href="<?php echo base_url();?>admin/Test_demo/view_result/<?php echo $_AllPublishOnGoingTest->test_id;?>_<?php echo $_AllPublishOnGoingTest->category_id;?>_<?php echo $_AllPublishOnGoingTest->id;?>">
                                            <button type="button" class="btn btn-info waves-effect waves-light float-right" style="margin-left: 5px;">Result</button> &nbsp; &nbsp;
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane p-3" id="UpComing" role="tabpanel">
                                <?php foreach ($AllPublishUpCommingTest as $_AllPublishUpCommingTest) { ?>
                                <div class="card col-sm-12" style="padding-left:0px; padding-right:0px; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)">
                                    <div class="card-header" style="padding: .5rem .8rem;">
                                        <div class="float-left" style="margin-top:8px"><b><i><?php echo $_AllPublishUpCommingTest->test_title;?></i></b>
                                        </div>
                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light float-right"><?php echo $_AllPublishUpCommingTest->category_name;?></button>
                                    </div>
                                    <div class="card-body" id="1286_data" data-name="sadasdasdasd" data-auto-unpublish="no" data-attempts="0" data-published="no" data-publish-date="2022-04-13 11:47:00" data-unpublish-date="0000-00-00 00:00:00" data-test-type="free">
                                        <p>Test Type: <b><?php echo $_AllPublishUpCommingTest->test_type;?></b> <br>
                                            Created by:  Admin<br>
                                            Questions: <?php echo $_AllPublishUpCommingTest->TotalQuestion;?> </p>
                                        Current Status: This test will be published automatically on <?php echo date("d M Y", strtotime($_AllPublishUpCommingTest->publish_at));?>.
                                        <button type="button" onclick="editTest(<?php echo $_AllPublishOnGoingTest->id;?>)" class="btn btn-warning waves-effect waves-light float-right"><i class="fa fa-edit"></i></button>
                                        <button type="button" onclick="deleteTest(<?php echo $_AllPublishOnGoingTest->id;?>)" style="margin-right: 5px;" class="btn btn-danger waves-effect waves-light float-right"><i class="fa fa-trash"></i></button>
                                        <button type="button" onclick="previewTest(596)" style="margin-right: 5px;" class="btn btn-primary waves-effect waves-light float-right"><i class="mdi mdi-eye"></i> Preview Test</button>
                                        <button type="button" onclick="publishTestNow(<?php echo $_AllPublishUpCommingTest->id;?>)" style="margin-right: 5px;" class="btn btn-success waves-effect waves-light float-right"><i class="mdi mdi-publish"></i> Publish Now</button>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane p-3" id="Created" role="tabpanel">
                                <?php foreach ($AllCreatedTest as $_AllCreatedTest) { ?>
                                <div class="card col-sm-12" style="padding-left:0px; padding-right:0px; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)">
                                    <div class="card-header" style="padding: .5rem .8rem;">
                                        <div class="float-left" style="margin-top:8px"><b><i><?php echo $_AllCreatedTest->test_title; ?></i></b> </div>
                                        <!--<button type="button" class="btn btn-outline-danger waves-effect waves-light float-right">GPSC </button>-->
                                    </div>
                                    <div class="card-body" id="33_data" data-name="Demo Test" data-auto-unpublish="yes" data-attempts="0" data-published="yes" data-publish-date="2021-10-12 08:15:49" data-unpublish-date="2021-04-13 09:19:00" data-test-type="free">
                                        <p>Test Type: <b><?php echo $_AllCreatedTest->test_type; ?></b><br>
                                            Created by: Admin <br>
                                            Questions: <?php echo $_AllCreatedTest->TotalQuestion;?> <br><br>
                                        </p> 
                                        <button type="button" onclick="editTest(<?php echo $_AllCreatedTest->id;?>)" class="btn btn-warning waves-effect waves-light float-right"><i class="fas fa-edit"></i></button>
                                        <button type="button" onclick="CreateddeleteTest(<?php echo $_AllCreatedTest->id;?>)" style="margin-right: 5px;" class="btn btn-danger waves-effect waves-light float-right"><i class="fa fa-trash"></i></button>
                                        <button type="button" onclick="publishTo(`<?php echo $_AllCreatedTest->id; ?>`)" style="margin-right: 5px;" class="btn btn-info waves-effect waves-light float-right">Publish</button>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane p-3" id="Deleted" role="tabpanel">
                                <?php foreach ($AllDeletedMainTest as $_AllDeletedMainTest) { ?>
                                <div class="card col-sm-12" style="padding-left:0px; padding-right:0px; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)">
                                    <div class="card-header" style="padding: .5rem .8rem;">
                                        <div class="float-left" style="margin-top:8px"><b><i><?php echo $_AllDeletedMainTest->test_title; ?></i></b> </div>
                                        <!--<button type="button" class="btn btn-outline-danger waves-effect waves-light float-right">GPSC </button>-->
                                    </div>
                                    <div class="card-body" id="33_data" data-name="Demo Test" data-auto-unpublish="yes" data-attempts="0" data-published="yes" data-publish-date="2021-10-12 08:15:49" data-unpublish-date="2021-04-13 09:19:00" data-test-type="free">
                                        <p>Test Type: <b><?php echo $_AllDeletedMainTest->test_type; ?></b><br>
                                            Created by: Admin <br>
                                            Questions: <?php echo $_AllDeletedMainTest->TotalQuestion;?> <br><br>
                                        </p> 
                                        <button type="button" onclick="publishTo(`<?php echo $_AllDeletedMainTest->id; ?>`)" style="margin-right: 5px;" class="btn btn-info waves-effect waves-light float-right">Publish</button>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php foreach ($AllDeleteTest as $_AllDeleteTest) { ?>
                                <div class="card col-sm-12" style="padding-left:0px; padding-right:0px; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)">
                                    <div class="card-header" style="padding: .5rem .8rem;">
                                        <div class="float-left" style="margin-top:8px"><b><i><?php echo $_AllDeleteTest->test_title; ?></i></b>
                                        </div>
                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light float-right"><?php echo $_AllDeleteTest->category_name;?></button>
                                    </div>
                                    <div class="card-body">
                                        <p>Test Type:  <b><?php echo $_AllDeleteTest->test_type; ?></b> <br>
                                            Created by:  Admin<br>
                                            Questions: <?php echo $_AllDeleteTest->TotalQuestion; ?></p>
                                            Current Status: <?php echo $_AllDeleteTest->status; ?> 
                                        <!--<button type="button" onclick="deleteTestfromdeleted(714, &quot;p&quot;)" style="margin-right: 5px;" class="btn btn-danger waves-effect waves-light float-right"><i class="fa fa-trash"></i></button>-->
                                        <!--  <button type="button" onclick='showResult("5ff343ecd44de56759257661")' style="margin-right: 5px;" class="btn btn-success waves-effect waves-light float-right"><i class="mdi mdi-format-page-break"></i> Result</button> -->
                                        <button type="button" onclick="publishTestNow(<?php echo $_AllDeleteTest->TotalQuestion; ?>)" style="margin-right: 5px;" class="btn btn-info waves-effect waves-light float-right"><i class="mdi mdi-publish"></i> Publish Now</button> 
                                        <button type="button" onclick="previewTest(714)" style="margin-right: 5px;" class="btn btn-primary waves-effect waves-light float-right"><i class="mdi mdi-eye"></i> Preview Test</button>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane p-3" id="UnPublished" role="tabpanel">
                                <?php foreach ($AllUnPublishTest as $_AllUnPublishTest) { ?>
                                <div class="card col-sm-12" style="padding-left:0px; padding-right:0px; box-shadow:0px 0px 13px 0px rgba(134, 134, 134, 0.44)">
                                    <div class="card-header" style="padding: .5rem .8rem;">
                                        <div class="float-left" style="margin-top:8px"><b><i><?php echo $_AllUnPublishTest->test_title;?></i></b>
                                        </div>
                                        <button type="button" class="btn btn-outline-danger waves-effect waves-light float-right"><?php echo $_AllUnPublishTest->category_name;?></button>
                                    </div>
                                    <div class="card-body" id="883_data" data-name="DEMO" data-auto-unpublish="yes" data-attempts="1" data-published="yes" data-publish-date="2022-01-09 02:00:00" data-unpublish-date="2022-01-09 02:00:00" data-test-type="locked">
                                        <p>Test Type:  <b><?php echo $_AllUnPublishTest->test_type;?></b> <br>
                                        Created by:  Admin<br>
                                        Questions: <?php echo $_AllUnPublishTest->TotalQuestion;?> </p>
                                        Current Status: <?php echo $_AllUnPublishTest->status;?>
                                        <button type="button" onclick="deleteTest(<?php echo $_AllUnPublishTest->id;?>)" style="margin-right: 5px;" class="btn btn-danger waves-effect waves-light float-right"><i class="fa fa-trash"></i></button>
                                        <button type="button" onclick="publishTestNow(<?php echo $_AllUnPublishTest->id;?>)" style="margin-right: 5px;" class="btn btn-primary waves-effect waves-light float-right"><i class="mdi mdi-eye"></i> Publish Test</button>
                                    </div>
                                </div>
                                <?php } ?>
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
<div id="PublishTestDiv"></div>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script> 
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

    
    
function publishTo(test_id) {
     
    $.ajax({
        url: "<?php echo base_url() . "admin/Test/publish_test"; ?>",
        method: "POST",
        data: {
            test_id: test_id,   
        },
        success: function(data) {
            $('#PublishTestDiv').html(data);
            $('#PublishTestModel').modal('show');
        }
    });
    
}
    
function editTest(test_id) {
     
    $.ajax({
        url: "<?php echo base_url() . "admin/Test/edit_cat_test"; ?>",
        method: "POST",
        data: {
            test_id: test_id,   
        },
        success: function(data) {
            $('#PublishTestDiv').html(data);
            $('#EditTestModel').modal('show');
        }
    });
    
}
function publishTestNow(test_cate_id) {
     
    if(confirm("Are you sure you want to Publish Test Now?")){
        $.ajax({
            url: "<?php echo base_url() . "admin/Test/publish_test_now"; ?>",
            method: "POST",
            data: {
                test_cate_id: test_cate_id,   
            },
            success: function(data) {
                window.location.reload();
            }
        });
     } else {
        return false;
    } 
}
function unpublishTest(test_cate_id) {
     
    if(confirm("Are you sure you want to Un-Publish Test?")){
        $.ajax({
            url: "<?php echo base_url() . "admin/Test/un_publish_test_now"; ?>",
            method: "POST",
            data: {
                test_cate_id: test_cate_id,   
            },
            success: function(data) {
                window.location.reload();
            }
        });
    } else {
        return false;
    } 
}
function deleteTest(test_cate_id) {
     
    if(confirm("Are you sure you want to Delete Test?")){
        $.ajax({
            url: "<?php echo base_url() . "admin/Test/delete_cat_test"; ?>",
            method: "POST",
            data: {
                test_cate_id: test_cate_id,   
            },
            success: function(data) {
                window.location.reload();
            }
        });
    } else {
        return false;
    } 
}
function CreateddeleteTest(test_id) {
     
    if(confirm("Are you sure you want to Delete Test?")){
        $.ajax({
            url: "<?php echo base_url() . "admin/Test/created_delete_test"; ?>",
            method: "POST",
            data: {
                test_id: test_id,   
            },
            success: function(data) {
                window.location.reload();
            }
        });
    } else {
        return false;
    } 
}
</script>