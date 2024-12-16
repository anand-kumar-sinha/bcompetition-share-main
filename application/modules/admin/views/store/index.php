<?php

if (isset($StoreDetail)) {
    $id = $StoreDetail->id;
    $course_category_id = $StoreDetail->course_category_id;
    $course_title = $StoreDetail->course_title;
    $course_description = $StoreDetail->course_description;
    $course_price = $StoreDetail->course_price;
    $course_offer_price = $StoreDetail->course_offer_price;
    $course_validity = $StoreDetail->course_validity;
    $course_image = $StoreDetail->course_image;
    $course_status = $StoreDetail->course_status;
   // $status = $StoreDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $course_category_id = '';
    $course_title = '';
    $course_description = '';
    $course_price = '';
    $course_offer_price = '';
    $course_validity = '';
    $course_image = '';
    $course_status = '1';
  //  $status = 1;
    $mode      = 'Add';
}
if (isset($AllCategory)) {
    $all_category = $AllCategory;
} else {
    $all_category = array();
}
?>

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Store</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Store List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Store_Form" method="post" action="<?php echo base_url(); ?>admin/Store/action" enctype="multipart/form-data" novalidate="novalidate">
                        <!-- Start : BOM Details -->
                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">    
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course_category_id" class="col-sm-12 control-label"
                                            style="font-weight: normal;"><span>*</span>
                                            Course
                                            Category</label>
                                        <div class="col-sm-12">
					                    <?php if(!empty($all_category) ) { ?>
                                            <select name="course_category_id" id="course_category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                <?php foreach ($all_category as $row){ ?>
                                                    <option value="<?php echo $row->id ; ?>" <?php if($row->id==$course_category_id){ echo 'selected'; }?> ><?php echo $row->category_name ; ?></option>
                                                <?php } ?>
                                            </select>
                                       <?php } ?>
                                        </div>
                                    </div>
				</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course_title" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>Course Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $course_title;?>" name="course_title" id="course_title" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course_description" class="col-sm-12 control-label"
                                            style="font-weight: normal;"><span>*</span>
                                            Course Description</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $course_description;?>" name="course_description" id="course_description"
                                                tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course_price" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>
                                            Course Price</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $course_price;?>" name="course_price" id="course_price" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course_offer_price" class="col-sm-12 control-label"
                                            style="font-weight: normal;"><span>*</span> Course Offer Price</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $course_offer_price;?>" name="course_offer_price" id="course_offer_price"
                                                tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course_validity" class="col-sm-12 control-label"
                                            style="font-weight: normal;"><span>*</span>
                                            Course
                                            Validity</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" name="course_validity" id="course_validity" tabindex="1">
                                                <option value="">-- Select Validity --</option>
                                                <option value="<?php echo '1 Month';?>"<?php if($course_validity== "1 Month"){ echo "selected";}?>>1 Month</option>
                                                <option value="<?php echo '2 Months';?>"<?php if($course_validity== "2 Months"){ echo "selected";}?>>2 Months</option>
                                                <option value="<?php echo '3 Months';?>"<?php if($course_validity== "3 Months"){ echo "selected";}?>>3 Months</option>
                                                <option value="<?php echo '4 Months';?>"<?php if($course_validity== "4 Months"){ echo "selected";}?>>4 Months</option>
                                                <option value="<?php echo '5 Months';?>"<?php if($course_validity== "5 Months"){ echo "selected";}?>>5 Months</option>
                                                <option value="<?php echo '6 Months';?>"<?php if($course_validity== "6 Months"){ echo "selected";}?>>6 Months</option>
                                                <option value="<?php echo '7 Months';?>"<?php if($course_validity== "7 Months"){ echo "selected";}?>>7 Months</option>
                                                <option value="<?php echo '8 Months';?>"<?php if($course_validity== "8 Months"){ echo "selected";}?>>8 Months</option>
                                                <option value="<?php echo '9 Months';?>"<?php if($course_validity== "9 Months"){ echo "selected";}?>>9 Months</option>
                                                <option value="<?php echo '10 Months';?>"<?php if($course_validity== "10 Months"){ echo "selected";}?>>10 Months</option>
                                                <option value="<?php echo '11 Months';?>"<?php if($course_validity== "11 Months"){ echo "selected";}?>>11 Months</option>
                                                <option value="<?php echo '12 Months';?>"<?php if($course_validity== "12 Months"){ echo "selected";}?>>12 Months</option>
                                                <option value="<?php echo '13 Months';?>"<?php if($course_validity== "13 Months"){ echo "selected";}?>>13 Months</option>
                                                <option value="<?php echo '14 Months';?>"<?php if($course_validity== "14 Months"){ echo "selected";}?>>14 Months</option>
                                                <option value="<?php echo '15 Months';?>"<?php if($course_validity== "15 Months"){ echo "selected";}?>>15 Months</option>
                                                <option value="<?php echo '16 Months';?>"<?php if($course_validity== "16 Months"){ echo "selected";}?>>16 Months</option>
                                                <option value="<?php echo '17 Months';?>"<?php if($course_validity== "17 Months"){ echo "selected";}?>>17 Months</option>
                                                <option value="<?php echo '18 Months';?>"<?php if($course_validity== "18 Months"){ echo "selected";}?>>18 Months</option>
                                                <option value="<?php echo '19 Months';?>"<?php if($course_validity== "19 Months"){ echo "selected";}?>>19 Months</option>
                                                <option value="<?php echo '20 Months';?>"<?php if($course_validity== "20 Months"){ echo "selected";}?>>20 Months</option>
                                                <option value="<?php echo '21 Months';?>"<?php if($course_validity== "21 Months"){ echo "selected";}?>>21 Months</option>
                                                <option value="<?php echo '22 Months';?>"<?php if($course_validity== "22 Months"){ echo "selected";}?>>22 Months</option>
                                                <option value="<?php echo '23 Months';?>"<?php if($course_validity== "23 Months"){ echo "selected";}?>>23 Months</option>
                                                <option value="<?php echo '24 Months';?>"<?php if($course_validity== "24 Months"){ echo "selected";}?>>24 Months</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Upload Image</label>
                                        <div class="col-sm-12">
                                              <?php if(!empty($course_image)){?>
                                            <img src="<?php echo  base_url('uploads/store_image/'.$course_image);?>" width="50" height="50">
                                             <?php } ?>
                                            <input type="file" class="form-control" name="course_image" id="course_image" tabindex="5">
                                            <input id="old_course_image" name="old_course_image" type="hidden" value="<?php echo $course_image;?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="course_status" class="col-sm-12 control-label"
                                            style="font-weight: normal;">Status</label>
                                        <div class="col-sm-12">
                                            <input type="radio" value="<?php echo 'Active';?>" <?php if($course_status== "Active"){ echo "selected";}?> name="course_status" checked="">Active
                                            <input type="radio" value="<?php echo 'In active'?>" <?php if($course_status== "In active"){ echo "selected";}?> name="course_status">De-active
                                        </div>
                                </div>
                                </div> -->
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="book_name" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Status</label>
                                            <?php 
                                            $statusarr = ["1" => "Active", "2" => "DeActive"];
                                            ?>
                                        <div class="col-sm-12">
                                           <select class="form-control" name="course_status">
                                            <?php foreach ($statusarr as $key => $value) { ?>
                                                  <option value="<?php echo $key ?>"<?= ($key == $course_status) ? ' selected' : ''; ?>><?php echo $value ?></option>
                                                  <!--   <option value="<?= $key?>"><?= $value?></option> -->
                                            <?php }?>
                                               
                                           </select>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!--  <div class="col-md-4">
                                    <?php if($course_image !=''){ ?>
                                        <img src="<?php echo base_url();?>uploads/store_image/<?php echo $course_image;?>" width="150px;">
                                    <?php } ?>
                                </div> -->
                            <div class="box-footer">
                                <a href="<?php echo base_url();?>admin/Store"><button type="button" class="btn btn-secondary">Cancel</button></a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                	<th style="width: 10%;">Course Title</th>
					                <th style="width: 10%;">Course Description</th>
					                <th style="width: 5%;">Course Price</th>
					                <th style="width: 5%;">Course Offer Price</th>
					                <th style="width: 10%;">Course Validity</th>
					                <th style="width: 2%;">Course Status</th>
					                <th style="width: 10%;">Action</th>
				                </tr>
                            </thead>
                        <tbody>
                                <?php foreach ($AllStoreDetail as $_AllStore) {
                                    // if($_AllStore->course_status== "Active"){
                                    //     $btnClass = "badge-success";
                                    // }
                                    // else{
                                    //     $btnClass = "badge-danger";
                                    // }
                                     if($_AllStore->course_status== "1"){
                                        $btnClass = "badge-success";
                                        $btnName = "Active";
                                    }
                                    else{
                                        $btnClass = "badge-danger";
                                        $btnName = "InActive";
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $_AllStore->course_title;?></td>
                                    <td><?php echo $_AllStore->course_description;?></td>
                                    <td><?php echo $_AllStore->course_price;?></td>
                                    <td><?php echo $_AllStore->course_offer_price;?></td>
                                    <td><?php echo $_AllStore->course_validity;?></td>
                                    <td style="text-align: center"><span class="badge <?php echo $btnClass; ?>"><?php echo $btnName; ?></span>
                                <td style="text-align: center">
                                    <a href="<?php echo base_url() . 'admin/Store/index?c_id=' . $_AllStore->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                    </a>                                           
                                    <a href="<?php echo base_url().'admin/Store/delete/'.$_AllStore->id; ?>" onclick="return confirm('Are you sure?');">
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                <a href="<?php echo base_url().'admin/Store/add_store_category?store_id='.$_AllStore->id; ?>" id="content" class="btn btn-primary waves-effect waves-light" style="font-size: 14px;line-height: 1;">Store Category</a>   
                                <a href="<?php echo base_url().'admin/Store/add_student?store_id='.$_AllStore->id; ?>" id="content" class="btn btn-primary waves-effect waves-light" style="font-size: 14px;line-height: 1;">Add Student</a>    
                                <!-- <a href="<?php echo base_url().'admin/Store/all_content_index?store_id='.$_AllStore->id; ?>" id="content" class="btn btn-primary waves-effect waves-light" style="font-size: 14px;line-height: 1;">Content</a>
                                <a href="<?php echo base_url().'admin/Store/all_live_class_index/'.$_AllStore->id;?>" id="content" class="btn btn-primary waves-effect waves-light" style="font-size: 14px;line-height: 1;">Live Class</a> -->
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

function CancelData() {
        $('#Store_Form').trigger("reset");
    }

    $(document).ready(function() {
        $(function() {
            $("#Store_Form").validate({
                rules: {
                    course_category_id: "required",
                    course_title: "required",
                    course_description: "required",
                    course_price: "required",
                    course_offer_price: "required",
                    course_validity: "required",
                    //course_image: "required",
                    course_status: "required",
                },

                messages: {
                    course_category_id: "Please Select Category",
                    course_title: "Please enter Course Title",
                    course_description: "Please enter Course Description",
                    course_price: "Please enter Course Price",
                    course_offer_price: "Please enter Course offer Price",
                    course_validity: "Please enter Course Validity",
                    //course_image: "Please enter Course Image",
                    course_status: "Please enter Course Status",
                }

            });

        });
    });
</script>