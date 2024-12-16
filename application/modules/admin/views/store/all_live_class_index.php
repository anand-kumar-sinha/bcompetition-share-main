<?php
if (isset($CourseContentDetail)) {
    $id = $CourseContentDetail->id;
    $store_id = $CourseContentDetail->store_id;
    $course_content_title = $CourseContentDetail->liveClassName;
    $liveClassStartDate = $CourseContentDetail->liveClassStartDate;
    $liveClassStartTime = $CourseContentDetail->liveClassStartTime;
    $liveClassMethod = $CourseContentDetail->liveClassMethod;
    $liveClassUrl = $CourseContentDetail->liveClassUrl;
    $course_content_status = $CourseContentDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $course_content_title = '';
    $course_content_status = '';
    $liveClassStartDate = date("d-m-Y");
    $liveClassStartTime = '';
    $liveClassMethod = '';
    $liveClassUrl = '';
    $mode      = 'Add';
}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">All Content</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Store">Store</a></li>
                        <li class="breadcrumb-item active">All Content</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <!-- <form id="courseContentDetailForm" method="post" action="<?php echo base_url(); ?>admin/Store/all_content_index_action" enctype="multipart/form-data" novalidate="novalidate"> -->
                            <form id="courseContentDetailForm" method="post" action="<?php echo base_url(); ?>admin/Store/all_liveclass_index_action?store_id=<?=$store_id?>&c_id=<?=$c_id?>" enctype="multipart/form-data" novalidate="novalidate">
                           <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" id="store_id" name="store_id" value="<?php echo $store_id; ?>">
                            <input type="hidden" id="c_id" name="c_id" value="<?php echo $c_id; ?>">

						<div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="courseContentTitle" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>Live Class Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $course_content_title;?>" name="course_content_title" id="course_content_title" tabindex="1">
                                    </div>									
                                </div>
                            </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="liveClassStartDate" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> Start
                                    Date</label>
                                <div class="col-sm-12">
                                    <div class="input-group-prepend date" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                        <input type="text" name="liveClassStartDate" id="liveClassStartDate" class="form-control"
                                            value="<?php echo $liveClassStartDate;?>">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                    
                        </div>
                         <div class="col-6">
							<div class="form-group">
								<label for="liveClassStartTime" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> Start Time</label>
								<div class="col-sm-12">
									<div class="input-group clockpicker" data-provide="clockpicker">
										<input type="text" name="liveClassStartTime" id="liveClassStartTime" value="<?php echo $liveClassStartTime;?>" class="form-control">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-time"></span>
										</div>
									</div>
								</div>									
							</div>
						</div>                                                    
                        <?php if(!empty($id)){
                            $method = ["1"=> 'Youtube',"2"=> 'Google meet',"3"=> 'Zoom'];
                            ?>
                        <div class="col-6">
                                <div class="form-group">
                                    <label for="courseContentTitle" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> Live Class Method</label>
                                    <div class="col-sm-12">
                                      <!--   <input type="text" class="form-control" value="<?php echo $liveClassMethod;?>" name="liveClassMethod" id="liveClassMethod" tabindex="1"> -->
                                      <select class="form-control" name="liveClassMethod" id="liveClassMethod">
                                        <?php foreach ($method as $Pkey => $Pvalue) { ?>
                                             <option value="<?php echo $Pkey; ?>" <?php if($Pkey == $liveClassMethod) echo "selected"; ?>><?php echo $Pvalue; ?></option>
                                    <?php } ?>
                                    </select>
                                    </div>                                  
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="courseContentTitle" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>Live Class URL</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $liveClassUrl;?>" name="liveClassUrl" id="liveClassUrl" tabindex="1">
                                    </div>                                  
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="subjectStatus" class="col-sm-12 control-label" style="font-weight: normal;">Status</label>
                                <div class="col-sm-12">
                              <!--       <input type="radio" value="Active" name="course_content_status" checked=""> <i></i> Active
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" value="De-active" name="course_content_status"> <i></i> De-active  -->
                                    <select class="custom-select" id="course_content_status" name="course_content_status">
                                        <option value="Active" <?php if($course_content_status == "Active"){ echo "selected";}?>>Active</option>
                                        <option value="In active" <?php if($course_content_status == "In active"){ echo "selected";}?>>In active</option>
                                    </select>
                                </div>                          
                            </div>
                        </div>
                            </div>
						    <div class="box-footer">
                                                <a href="<?php echo base_url();?>admin/Store"><button type="button" class="btn btn-secondary">Cancel</button></a>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
					                <th style="width: 10%;">Live Class Title</th>
					                <th style="width: 5%;">Start Date</th>
					                <th style="width: 5%;">Start Time</th>
					                <th style="width: 10%;">Live Class URL</th>
					                <th style="width: 2%;">Status</th>
					                <th style="width: 10%;">Action</th>
				                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllLiveClass as $_AllLiveClass) {
                                    if($_AllLiveClass->status == "Active"){
                                        $btnClass = "badge-success";
                                        $statusname = "Active";
                                    }else{
                                        $btnClass = "badge-danger";
                                        $statusname = "InActive";
                                    }
                                    ?>
                                    <tr> 
                                        <td><?php echo $_AllLiveClass->liveClassName; ?></td>
                                        <td><?php echo $_AllLiveClass->liveClassStartDate; ?></td>
                                        <td><?php echo $_AllLiveClass->liveClassStartTime; ?></td>
                                        <td><?php echo $_AllLiveClass->liveClassUrl; ?></td>
                                       <td><span class="badge <?php echo $btnClass; ?>"><?php echo $statusname; ?></span>
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'admin/Store/all_live_class_index?s_id='.$_AllLiveClass->id.'&c_id=' . $_AllLiveClass->category_id.'&store_id='.$_AllLiveClass->store_id;; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </a>  
                                              <a href="<?php echo base_url() . 'admin/Store/addLiveClassSession?s_id='.$_AllLiveClass->id?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-sm">LiveClass</button>
                                            </a>                     
                                            <?php if(!empty($_AllLiveClass->liveClassUrl)){ ?>
                                                <a class="popup-youtube" href="<?php echo $_AllLiveClass->liveClassUrl?>"><button class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button></a>
                                          
                                            <?php } ?>
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
    </div>
</div>
<script type="text/javascript">
    
    $(function() {
    $('.popup-youtube').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
});
</script>
<script>
$('.clockpicker').clockpicker();

function CancelData() {
        $('#courseContentDetailForm').trigger("reset");
    }

    $(document).ready(function() {
        $(function() {
            $("#courseContentDetailForm").validate({
                rules: {
                    course_content_file_type: "required",
                    course_content_title: "required",
                    course_content_detail: "required",
                    course_content_pdf_file: "required",
                    course_content_video_link: "required",
                    course_content_status: "required",
                },

                messages: {
                    course_content_file_type: "Please enter Course Content File Type",
                    course_content_title: "Please enter Course Content Title",
                    course_content_detail: "Please enter Course Content Description",
                    course_content_pdf_file: "Please enter Course Content PDF",
                    course_content_video_link: "Please enter Course Content Video Link",
                    course_content_status: "Please enter Course Content Status",
                }

            });

        });
    });


</script>