<?php

if (isset($PackageDetail)) {
    $id = $PackageDetail->id;

    $package_name = $PackageDetail->package_name;
    $package_desc = $PackageDetail->package_desc;
    $package_thumbnil = $PackageDetail->package_thumbnil;
    $package_price = $PackageDetail->package_price;
    $package_offer_price = $PackageDetail->package_offer_price;
    $package_image = $PackageDetail->package_image;
    $package_link = $PackageDetail->package_link;
    $status = $PackageDetail->status;
    $image_name = $PackageDetail->image_name;
    $book_name = $PackageDetail->book_name;
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
    $package_link = '';
    $status = '';
    $image_name = '';
    $book_name = '';
    $status = 1;
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
                        <form id="Store_Form" method="post" action="<?php echo base_url(); ?>admin/Manage_package_info/action" enctype="multipart/form-data" novalidate="novalidate">
                        <!-- Start : BOM Details -->
                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">    
                        <div class="row">
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_name" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>Package Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $package_name;?>" name="package_name" id="package_name" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_thumbnil" class="col-sm-12 control-label" style="font-weight: normal;"><span>*</span>Package Thumbnil</label>
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
                                            Package Price</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $package_price;?>" name="package_price" id="package_price" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_offer_price" class="col-sm-12 control-label"
                                            style="font-weight: normal;"><span>*</span> Package Offer Price</label>
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
                                            Package Description</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $package_desc;?>" name="package_desc" id="package_desc"
                                                tabindex="1">
                                        </div>
                                    </div>
                                </div>
                               
                               
                              
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_image" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Package Image</label>
                                        <div class="col-sm-12">
                                        <?php if(!empty($package_thumbnil)){?>
                                            <img width="50" height="50" src="<?php echo  base_url('uploads/package_image/'.$package_image);?>">
                                        <?php } ?>
                                            <input type="file" class="form-control" name="package_image" id="package_image" tabindex="5">
                                            <input id="old_package_image" name="old_package_image" type="hidden" value="<?php echo $package_image;?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="package_link" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Package Book Link</label>
                                        <div class="col-sm-12">
                                             <?php if(!empty($package_link)){?>
                                            <p><?php echo  base_url('uploads/package_image/'.$package_link);?></p>
                                             <?php } ?>
                                             <input type="file" class="form-control" name="package_link" id="package_link" tabindex="5">
                                            <input id="old_package_link" name="old_package_link" type="hidden" value="<?php echo $package_link;?>" class="form-control">
                                           
                                         
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image_name" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                           Image Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $image_name;?>" name="image_name" id="image_name" tabindex="5">
                                         
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="book_name" class="col-sm-12 control-label" style="font-weight: normal;"><span></span>
                                            Book Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" value="<?php echo $book_name;?>" name="book_name" id="book_name" tabindex="5">
                                         
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-4">
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
                                   
                                    <td style="text-align: center"><span class="badge <?php echo $btnClass; ?>"><?php echo $btnName; ?></span>
                                <td style="text-align: center">
                                    <a href="<?php echo base_url() . 'admin/Manage_package_info/index?c_id=' . $_AllStore->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                    </a>                                           
                                    <a href="<?php echo base_url().'admin/Manage_package_info/delete/'.$_AllStore->id; ?>" onclick="return confirm('Are you sure?');">
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                              </a>
                               <a href="<?php echo base_url().'admin/Manage_package_info/add_student?store_id='.$_AllStore->id; ?>" id="content" class="btn btn-primary waves-effect waves-light" style="font-size: 14px;line-height: 1;">Add Student</a>    
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