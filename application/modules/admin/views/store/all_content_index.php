<?php

$store_id_x = $this->input->get('store_id');

if (isset($StoreContentDetail)) {
    $id = $StoreContentDetail->id;
    $store_id = $StoreContentDetail->store_id;
    $course_content_file_type = $StoreContentDetail->course_content_file_type;
    $course_content_title = $StoreContentDetail->course_content_title;
    $course_content_detail = $StoreContentDetail->course_content_detail;
    $course_content_pdf_file = $StoreContentDetail->course_content_pdf_file;
    $course_content_video_link = $StoreContentDetail->course_content_video_link;
    $course_content_status = $StoreContentDetail->course_content_status;
    $mode          = 'Edit';
} else {
    $id = '';
    $course_content_file_type = '';
    $course_content_title = '';
    $course_content_detail = '';
    $course_content_pdf_file = '';
    $course_content_video_link = '';
    $course_content_status = '';
    $mode      = 'Add';
}
?>
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
                        <form id="courseContentDetailForm" method="post" action="<?php echo base_url(); ?>admin/Store/all_content_index_action?store_id=<?=$store_id_x?>" enctype="multipart/form-data" novalidate="novalidate">
                           <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" id="c_id" name="c_id" value="<?php echo $c_id; ?>">
                            		  <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="courseContentFileType" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> File Type</label>
                                                            <div class="col-sm-12">
								<select class="form-control" name="course_content_file_type" id="course_content_file_type" tabindex="1">
                                                                    <option value="">-- select file type --</option>
                                                                    <option value="<?php echo 'PDF';?>"<?php if($course_content_file_type== "PDF"){ echo "selected";}?>>PDF</option>
                                                                    <option value="<?php echo 'Video link';?>"<?php if($course_content_file_type== "Video link"){ echo "selected";}?>>Video Link</option>
                                                                </select>	
                                                            </div>									
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="courseContentTitle" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> Course Content Title</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" value="<?php echo $course_content_title;?>" name="course_content_title" id="course_content_title" tabindex="1">
                                                            </div>									
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="courseContentDetail" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> Course Content Detail</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" value="<?php echo $course_content_detail;?>" name="course_content_detail" id="course_content_detail" tabindex="1">
                                                            </div>									
                                                        </div>
                                                    </div>
                                                    <?php if(!empty($course_content_pdf_file)){ ?>
                                                    
                                                    <div class="col-6" id="contentPdf">
                                                        <div class="form-group">
                                                            <label for="courseContentFile" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> Course Content PDF File</label>
                                                            <div class="col-sm-12">
                                                                <span><?php echo $course_content_pdf_file;?></span>
                                                                <input type="file" class="form-control"  name="course_content_pdf_file" id="course_content_pdf_file1" tabindex="1">
                                                            </div>									
                                                        </div>
                                                    </div>
                                                    <?php } else {?>
                                                     <div class="col-6" id="contentPdf" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="courseContentFile" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> Course Content PDF File</label>
                                                            <div class="col-sm-12">
                                                                <input type="file" class="form-control"  name="course_content_pdf_file" id="course_content_pdf_file" tabindex="1">
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                 <?php if(!empty($course_content_video_link)){ ?>
                                                    <div class="col-6" id="contentVideoLink">
                                                        <div class="form-group">
                                                            <label for="courseContentVideoLink" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> Course Content Video Link</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" value="<?php echo $course_content_video_link;?>" name="course_content_video_link" id="course_content_video_link" tabindex="1">
                                                            </div>									
                                                        </div>
                                                    </div>
                                                      <?php } else {?>
                                                         <div class="col-6" id="contentVideoLink" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="courseContentVideoLink" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span> Course Content Video Link</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" value="<?php echo $course_content_video_link;?>" name="course_content_video_link" id="course_content_video_link" tabindex="1">
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                         <?php } ?>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="subjectStatus" class="col-sm-12 control-label" style="font-weight: normal;">Status</label>
                                                            <div class="col-sm-12">
                                                                <input type="radio" value="Active" name="course_content_status" checked=""> <i></i> Active
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input type="radio" value="De-active" name="course_content_status"> <i></i> De-active 
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
					                <th style="width: 10%;">File Type</th>
					                <th style="width: 10%;">Content Title</th>
					                <th style="width: 5%;">Content Detail</th>
					                <th style="width: 5%;">Content PDF File</th>
					                <th style="width: 10%;">Content Video Link</th>
					                <th style="width: 2%;">Content Status</th>
					                <th style="width: 10%;">Action</th>
				                </tr>
                            </thead>
                        <tbody>
                                <?php foreach ($AllCourceContent as $_AllContent) {
                                    if($_AllContent->course_content_status== "Active"){
                                        $btnClass = "badge-success";
                                    }
                                    else{
                                        $btnClass = "badge-danger";
                                    }

					if($_AllContent->store_id == $this->input->get('store_id'))
					{
	?>
  <tr>
                                    <td><?php echo $_AllContent->course_content_file_type;?></td>
                                    <td><?php echo $_AllContent->course_content_title;?></td>
                                    <td><?php echo $_AllContent->course_content_detail;?></td>
                                    <td><?php echo $_AllContent->course_content_pdf_file;?></td>
                                    <td><?php echo $_AllContent->course_content_video_link;?></td>
                                    <td style="text-align: center"><span class="badge <?php echo $btnClass; ?>"><?php echo $_AllContent->course_content_status; ?></span>
                                <td style="text-align: center">
                                    <a href="<?php echo base_url() . 'admin/Store/all_content_index?s_id=' . $_AllContent->id.'&c_id='.$_AllContent->category_id.'&store_id='.$store_id_x; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                    </a>                                           
                                    <a href="<?php echo base_url().'admin/Store/all_content_index_delete/all_content_index/'.$_AllContent->id; ?>" onclick="return confirm('Are you sure?');">
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </a>
                                    </td>
                                </tr>
	<?php
					}

                                ?>
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


<script>

$("#course_content_file_type").change(function() {
        if($(this).val() == "PDF") {
            $("#contentPdf").show();
            $("#contentVideoLink").hide();
        }
        else {
            $("#contentPdf").hide();
            $("#contentVideoLink").show();
        }
    });
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
                    //course_content_pdf_file: "required",
                    course_content_video_link: "required",
                    course_content_status: "required",
                },

                messages: {
                    course_content_file_type: "Please enter Course Content File Type",
                    course_content_title: "Please enter Course Content Title",
                    course_content_detail: "Please enter Course Content Description",
                    //course_content_pdf_file: "Please enter Course Content PDF",
                    course_content_video_link: "Please enter Course Content Video Link",
                    course_content_status: "Please enter Course Content Status",
                }

            });

        });
    });
</script>