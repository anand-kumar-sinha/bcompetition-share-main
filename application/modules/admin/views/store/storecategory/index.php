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

                <div class="col-sm-6">
                    <h4 class="page-title">Store Category</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Store  Category List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Category_Form" method="post" action="<?php echo base_url(); ?>admin/Store/actionAddStoreCategory" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" id="store_id" name="store_id" value="<?php echo $store_id; ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Store Category Name <span class="error">*</span></label>
                                        <input id="category_name" name="category_name" type="text" value="<?php echo $category_name;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtLastNameBilling">Status</label>
                                        <select class="custom-select" id="status" name="status">
                                            <option value="Active" <?php if($status == "Active"){ echo "selected";}?>>Active</option>
                                            <option value="In active" <?php if($status == "In active"){ echo "selected";}?>>In active</option>
                                        </select>
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
                                   <th>Store Category Name</th>
                                   <th style="width: 10%;">Status</th>
                                   <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllCategory as $_AllCategory) {
                                    if($_AllCategory->status == "Active"){
                                        $btnClass = "badge-success";
                                    }else{
                                        $btnClass = "badge-danger";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $_AllCategory->category_name; ?></td>
                                        <td><span class="badge <?php echo $btnClass; ?>"><?php echo $_AllCategory->status; ?></span>
                                            <!--<span class="btn btn-block btn-sm <?php //echo $btnClass; ?>"><?php //echo $_AllCategory->status; ?></span></td>-->
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'admin/Store/add_store_category/index?c_id=' . $_AllCategory->id.'&store_id='.$store_id;; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'admin/Store/delete_store_category?c_id='.$_AllCategory->id.'&s_id='.$store_id; ?>" onclick="return confirm('Are you sure?');">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </a>
                                             <a href="<?php echo base_url().'admin/Store/all_content_index?store_id='.$store_id.'&c_id='.$_AllCategory->id; ?>" id="content" class="btn btn-primary waves-effect waves-light" style="font-size: 14px;line-height: 1;">Content</a>
                                            <a href="<?php echo base_url().'admin/Store/all_live_class_index/?store_id='.$store_id.'&c_id='.$_AllCategory->id;?>" id="content" class="btn btn-primary waves-effect waves-light" style="font-size: 14px;line-height: 1;">Live Class</a>
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

    
    
</script>