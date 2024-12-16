<?php
if (isset($Banner_masterDetail)) {
    $id = $Banner_masterDetail->id;
    $banner = $Banner_masterDetail->banner;
    $category_id = $Banner_masterDetail->category_id;
    $mode          = 'Edit';
} else {
    $id = '';
    $banner = '';
    $category_id = '';
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
                    <h4 class="page-title">Banner_master</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Banner_master List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h5><?php echo $mode; ?> Banner</h5>
                        </div>
                        <form id="Banner_master_Form" method="post" action="<?php echo base_url(); ?>admin/Banner_master/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Banner Image<span class="error">*</span></label>
                                        <input id="banner" name="banner" type="file" value="" class="form-control">
                                        <input id="old_banner" name="old_banner" type="hidden" value="<?php echo $banner;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php if($banner !=''){ ?>
                                    <img src="<?php echo base_url();?>uploads/banner_image/<?php echo $banner;?>" width="150px;">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Banner Category</label>
                                        <?php if(!empty($all_category) ) { ?>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category</option>
                                                <?php foreach ($all_category as $row){ ?>
                                                    <option value="<?php echo $row->id ; ?>" <?php if($row->id==$category_id){ echo 'selected'; }?> ><?php echo $row->category_name ; ?></option>
                                                <?php } ?>
                                            </select>
                                       <?php } ?>
                                    </div>
                                </div> 
                            </div> 
                                        
                                        
                            <div class="box-footer">
                                <a href="<?php echo base_url();?>admin/Banner_master"><button type="button" class="btn btn-secondary">Cancel</button></a>
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
                                   <th>Banner Image</th>
                                   <th>Banner Category</th>
                                   <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllBanner_master as $_AllBanner_master) {  ?>
                                    <tr>
                                        <td>
                                            <?php if($_AllBanner_master->banner !=''){ ?>
                                            <img src="<?php echo base_url();?>uploads/banner_image/<?php echo $_AllBanner_master->banner;?>" width="150px;">
                                            <?php } ?>
                                        </td>
										<td>
											<?php if($_AllBanner_master->category_name !=''){ ?>
												<?php echo $_AllBanner_master->category_name;?>
                                            <?php } else {
												echo "-";
											} ?>
											</td>
                                            <!--<span class="btn btn-block btn-sm <?php //echo $btnClass; ?>"><?php //echo $_AllBanner_master->status; ?></span></td>-->
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'admin/Banner_master/index?c_id=' . $_AllBanner_master->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'admin/Banner_master/delete/'.$_AllBanner_master->id; ?>" onclick="return confirm('Are you sure?');">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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
        $('#Banner_master_Form').trigger("reset");
    }
    
    $(document).ready(function() {
//        $('.select2').select2();
        $(function() {

            // Setup form validation on the #register-form element
            $("#Banner_master_Form").validate({
                // Specify the validation rules
                rules: {
                //    banner: "required",
                },

                // Specify the validation error messages
                messages: {
                    banner: "Please enter country name",
                }

            });

        });
    });

    
    
</script>