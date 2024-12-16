<?php

if (isset($PackageDetail)) {
    $id = $PackageDetail->id;

    $package_name = $PackageDetail->package_name;
    $package_desc = $PackageDetail->package_desc;
    $package_thumbnil = $PackageDetail->package_thumbnil;
    $package_price = $PackageDetail->package_price;
    $package_offer_price = $PackageDetail->package_offer_price;
    $package_image = $PackageDetail->package_image;
    
    $level1_group_member = $PackageDetail->level1_group_member;
    $level1_group_member_amount = $PackageDetail->level1_group_member_amount;
    $level2_group_member = $PackageDetail->level2_group_member;
    $level2_group_member_amount = $PackageDetail->level2_group_member_amount;
    $level3_group_member = $PackageDetail->level3_group_member;
    $level3_group_member_amount = $PackageDetail->level3_group_member_amount;
    $level4_group_member = $PackageDetail->level4_group_member;
    $level4_group_member_amount = $PackageDetail->level4_group_member_amount;
    $level5_group_member = $PackageDetail->level5_group_member;
    $level5_group_member_amount = $PackageDetail->level5_group_member_amount;
 $status = $PackageDetail->status;

    $mode          = 'Edit';
} else {
    $id = '';
   
    $package_name = '';
    $package_desc = '';
    $package_price = '';
    $package_thumbnil = '';
    $package_offer_price = '';
    $package_image = '';
     $status = 1;
     $level1_group_member = '';
    $level1_group_member_amount = '';
    $level2_group_member = '';
    $level2_group_member_amount = '';
    $level3_group_member = '';
    $level3_group_member_amount = '';
    $level4_group_member = '';
    $level4_group_member_amount = '';
    $level5_group_member = '';
    $level5_group_member_amount = '';

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
                    <h4 class="page-title">Manage Auto Pool</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Auto Pool List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Store_Form" method="post" action="<?php echo base_url(); ?>admin/Manage_autopool_package/action" enctype="multipart/form-data" novalidate="novalidate">
                        <!-- Start : BOM Details -->
                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">    
                        <div class="row">
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_name" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>AutoPool Package Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $package_name;?>" name="package_name" id="package_name" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_thumbnil" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>AutoPool Package Thumbnil</label>
                                        <div class="col-sm-12">
                                            <?php if(!empty($package_thumbnil)){?>
                                            <img width="50" height="50" src="<?php echo  base_url('uploads/package_image/'.$package_thumbnil);?>">
                                        <?php } ?>
                                            <input type="file" class="form-control" name="package_thumbnil" id="package_thumbnil" tabindex="5">
                                            <input id="old_thum_image" name="old_thum_image" type="hidden" value="<?php echo $package_thumbnil;?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_price" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>
                                            AutoPool Package Price</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $package_price;?>" name="package_price" id="package_price" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_offer_price" class="col-sm-12 control-label"
                                            style="font-weight: normal;"><span>*</span> AutoPool Package Offer Price</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $package_offer_price;?>" name="package_offer_price" id="package_offer_price"
                                                tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_desc" class="col-sm-12 control-label"
                                            style="font-weight: normal;"><span>*</span>
                                            AutoPool Package Description</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $package_desc;?>" name="package_desc" id="package_desc"
                                                tabindex="1">
                                        </div>
                                    </div>
                                </div>
                               
                               
                              
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            AutoPool Package Image</label>
                                        <div class="col-sm-12">
                                        <?php if(!empty($package_thumbnil)){?>
                                            <img width="50" height="50" src="<?php echo  base_url('uploads/package_image/'.$package_image);?>">
                                        <?php } ?>
                                            <input type="file" class="form-control" name="package_image" id="package_image" tabindex="5">
                                            <input id="old_package_image" name="old_package_image" type="hidden" value="<?php echo $package_image;?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                               
                               
                            </div>

                                <h4>Manage Student Group</h4>
                            <div class="row">
                                <div class="col-md-6">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level1 Group Member</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level1_group_member;?>" name="level1_group_member" id="level1_group_member"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level1 Group Amount</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level1_group_member_amount;?>" name="level1_group_member_amount" id="level1_group_member_amount"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6 custom_css">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level2 Group Member</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level2_group_member;?>" name="level2_group_member" id="level2_group_member"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6 custom_css">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level2 Group Amount</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level2_group_member_amount;?>" name="level2_group_member_amount" id="level2_group_member_amount"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6 custom_css">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level3 Group Member</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level3_group_member;?>" name="level3_group_member" id="level3_group_member"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6 custom_css">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level3 Group Amount</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level3_group_member_amount;?>" name="level3_group_member_amount" id="level3_group_member_amount"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6 custom_css">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level4 Group Member</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level4_group_member;?>" name="level4_group_member" id="level4_group_member"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6 custom_css">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level4 Group Amount</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level4_group_member_amount;?>" name="level4_group_member_amount" id="level4_group_member_amount"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6 custom_css" style="margin-bottom: 10px;">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level5 Group Member</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level5_group_member;?>" name="level5_group_member" id="level5_group_member"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6 custom_css">
                                     <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Level5 Group Amount</label>
                                        <div class="col-sm-12">
                                        <input type="text" class="form-control" value="<?php echo $level5_group_member_amount;?>" name="level5_group_member_amount" id="level5_group_member_amount"
                                                tabindex="1">
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="book_name" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Status</label>
                                            <?php 
                                            $statusarr = ["1" => "Active", "2" => "DeActive"];
                                            ?>
                                        <div class="col-sm-12">
                                           <select class="form-control" name="status">
                                            <?php foreach ($statusarr as $key => $value) { ?>
                                                  <option value="<?php echo $key ?>"<?= ($key == $status) ? ' selected' : ''; ?>><?php echo $value ?></option>
                                                  <!--   <option value="<?= $key?>"><?= $value?></option> -->
                                            <?php }?>
                                               
                                           </select>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>

                               
                          
                            <div class="box-footer custom_css">
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
                                	<th style="width: 10%;">Package Name</th>
					                <th style="width: 10%;">Package Thumbnil</th>
					                <th style="width: 5%;">Package Price</th>
					                <th style="width: 5%;">Package Offer Price</th>
                                      <th style="width: 2%;">Package Status</th>
					                <th style="width: 10%;">Action</th>
				                </tr>
                            </thead>
                        <tbody>
                                <?php 

                                foreach ($package_data as $_AllStore) {
                                       if($_AllStore->status== "1"){
                                        $btnClass = "badge-success";
                                        $btnName = "Active";
                                    }
                                    else{
                                        $btnClass = "badge-danger";
                                        $btnName = "InActive";
                                    }
                                   
                                ?>
                                <tr>
                                    <td><?php echo $_AllStore->package_name;?></td>
                                    <td><img width="50" height="50" src="<?php echo  base_url('uploads/package_image/'.$_AllStore->package_thumbnil);?>"></td>
                                    <td><?php echo $_AllStore->package_price;?></td>
                                    <td><?php echo $_AllStore->package_offer_price;?></td>
                                   
                                    <td style="text-align: center"><span class="badge <?php echo $btnClass; ?>"><?php echo $btnName; ?></span></td>
                                <td style="text-align: center">
                                    <a href="<?php echo base_url() . 'admin/Manage_autopool_package/index?c_id=' . $_AllStore->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                    </a>                                           
                                    <a href="<?php echo base_url().'admin/Manage_autopool_package/delete/'.$_AllStore->id; ?>" onclick="return confirm('Are you sure?');">
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                        <a href="<?php echo base_url().'admin/Manage_autopool_package/add_student?store_id='.$_AllStore->id; ?>" id="content" class="btn btn-primary waves-effect waves-light" style="font-size: 14px;line-height: 1;">Add Student</a>   
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
<style type="text/css">
    .custom_css{
        margin-top: 10px;
    }
</style>
<script>

function CancelData() {
        $('#Store_Form').trigger("reset");
    }

    $(document).ready(function() {
        $(function() {
            $("#Store_Form").validate({
                rules: {
                 
                    package_name: "required",
                    package_desc: "required",
                    package_price: "required",
                    package_offer_price: "required",
                   
                },

                messages: {
                   
                    package_name: "Please enter Package Title",
                    package_desc: "Please enter Package Description",
                    package_price: "Please enter Package Price",
                    package_offer_price: "Please enter Package offer Price",
                   
                }

            });

        });
    });
</script>