<?php
if (isset($BranchDetail)) {
    $id = $BranchDetail->id;
    $branch_name = $BranchDetail->branch_name;
    $head_admin_name = $BranchDetail->head_admin_name;
    $email = $BranchDetail->email;
    $contact_number = $BranchDetail->contact_number;
    $password = $BranchDetail->password;
    $start_date = date("d-m-Y", strtotime($BranchDetail->start_date));
    $branch_code = $BranchDetail->branch_code;
    $address = $BranchDetail->address;
    $status = $BranchDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $branch_name = '';
    $head_admin_name = '';
    $email = '';
    $contact_number = '';
    $password = '';
    $start_date = '';
    $branch_code = '';
    $address = '';
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
                    <h4 class="page-title">Branch</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>super_admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Branch List</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Branch_Form" method="post" action="<?php echo base_url(); ?>super_admin/Branch/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Branch Name <span class="error">*</span></label>
                                        <input id="branch_name" name="branch_name" type="text" value="<?php echo $branch_name;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Head/Admin Name <span class="error">*</span></label>
                                        <input id="head_admin_name" name="head_admin_name" type="text" value="<?php echo $head_admin_name;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Email<span class="error">*</span></label>
                                        <input id="email" name="email" type="email" value="<?php echo $email;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> Branch Code<span class="error">*</span></label>
                                        <input id="branch_code" name="branch_code" type="text" value="<?php echo $branch_code;?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Contact Number<span class="error">*</span></label>
                                        <input id="contact_number" name="contact_number" type="text" value="<?php echo $contact_number;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Password<span class="error">*</span></label>
                                        <input id="password" name="password" type="password" value="" class="form-control">
                                        <input id="old_password" name="old_password" type="hidden" value="<?php echo $password;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Start Date<span class="error">*</span></label>
                                        <input id="start_date" name="start_date" type="text" value="<?php echo $start_date;?>" class="form-control">
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtLastNameBilling">Status</label>
                                        <select class="custom-select" id="status" name="status">
                                            <option value="Active" <?php if($status == "Active"){ echo "selected";}?>>Active</option>
                                            <option value="In active" <?php if($status == "In active"){ echo "selected";}?>>In active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling"> Address<span class="error">*</span></label>
                                        <input id="address" name="address" type="text" value="<?php echo $address;?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="box-footer">
                                <button type="button" class="btn btn-secondary" onclick="CancelData();">Cancel</button>
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
                                   <th>Name</th>
                                   <th>Head/Admin Name</th>
                                   <th>Email</th>
                                   <th>Contact Number</th>
                                   <th>Start Date</th>
                                   <th style="width: 8%;">Status</th>
                                   <th style="width: 8%;">Created</th>
                                   <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllBranch as $_AllBranch) {
                                    if($_AllBranch->status == "Active"){
                                        $btnClass = "badge-success";
                                    }else{
                                        $btnClass = "badge-danger";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $_AllBranch->branch_name; ?></td>
                                        <td><?php echo $_AllBranch->head_admin_name; ?></td>
                                        <td><?php echo $_AllBranch->email; ?></td>
                                        <td><?php echo $_AllBranch->contact_number; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($_AllBranch->start_date)); ?></td>
                                        <td><span class="badge <?php echo $btnClass; ?>"><?php echo $_AllBranch->status; ?></span>
                                        <td><?php echo date("d-m-Y", strtotime($_AllBranch->created)); ?></td>
                                            <!--<span class="btn btn-block btn-sm <?php //echo $btnClass; ?>"><?php //echo $_AllBranch->status; ?></span></td>-->
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'super_admin/Branch/index?br_id=' . $_AllBranch->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'super_admin/Branch/delete/'.$_AllBranch->id; ?>" onclick="return confirm('Are you sure?');">
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
    $('#start_date').datepicker({
        format: "dd-mm-yyyy",
        todayHighlight: true,
        autoclose: true,
    });
    function CancelData() {
        $('#Branch_Form').trigger("reset");
    }
    
    $(document).ready(function() {
//        $('.select2').select2();
        $(function() {

            // Setup form validation on the #register-form element
            $("#Branch_Form").validate({
                // Specify the validation rules
                rules: {
                    branch_name: "required",
                    head_admin_name: "required",
                    email: "required",
                    branch_code: "required",
                    start_date: "required",
                    contact_number: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    password: {
                        <?php if($mode == "Add"){ ?>
                            required: true,
                        <?php } ?>
                            minlength: 6
                    },
                },

                // Specify the validation error messages
                messages: {
                    branch_name: "Please enter branch name",
                    head_admin_name: "Please enter admin name",
                    email: "Please enter email",
                    branch_code: "Please enter branch code",
                    start_date: "Please enter start date",
                    contact_number: {
                        required: "Enter Contact No",
                        number: "Enter only number",
                        maxlength: "Please enter maximum 10 latters in Number",
                        minlength: "Please enter minimum 10 latters in Number",
                    },
                     password: {
                        required: "Please enter a valid password",
                        minlength: "Your password must be at least 6 characters long",
                    },
                }

            });

        });
    });

    
    
</script>