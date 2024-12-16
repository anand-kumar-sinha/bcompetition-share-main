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
                    <h4 class="page-title">Profile</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                       
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <!-- <form id="courseContentDetailForm" method="post" action="<?php echo base_url(); ?>admin/Store/all_content_index_action" enctype="multipart/form-data" novalidate="novalidate"> -->
                            <form id="courseContentDetailForm" method="post" action="<?php echo base_url(); ?>admin/Profile_setting/changeProfile" enctype="multipart/form-data" novalidate="novalidate">
                           <!-- Start : BOM Details -->
                          

						<div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="courseContentTitle" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $getlogin_master->name;?>" name="name" id="name" tabindex="1">
                                    </div>									
                                </div>
                            </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="liveClassStartDate" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> User Name</label>
                                 <div class="col-sm-12">
                                        <input type="number" class="form-control" value="<?php echo $getlogin_master->username;?>" name="username" id="username" tabindex="1">
                                    </div>  
                            </div>                                                    
                        </div>
                         <div class="col-6">
							<div class="form-group">
								<label for="liveClassStartTime" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>Email</label>
								 <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $getlogin_master->email;?>" name="email" id="email" tabindex="1">
                                    </div>  								
							</div>
						</div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="liveClassStartTime" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>Password</label>
                                 <div class="col-sm-12">
                                        <input type="password" class="form-control"  name="password" id="password" tabindex="1">
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
           
                </div>
        </div>
        </div>
    </div>
</div>
