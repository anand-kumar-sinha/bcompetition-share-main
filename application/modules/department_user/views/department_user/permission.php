<?php
if (isset($DepartmentUserDetail)) {
    $id = $DepartmentUserDetail->id;
    $department_id = $DepartmentUserDetail->department_id;
    $user_name = $DepartmentUserDetail->user_name;
    $contact_number = $DepartmentUserDetail->contact_number;
    $role = $DepartmentUserDetail->role;
    $password = $DepartmentUserDetail->password;
    $status = $DepartmentUserDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $department_id = '';
    $user_name = '';
    $contact_number = '';
    $role = '';
    $password = '';
    $status = '';
    $mode      = 'Add';
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/department_user">Department User List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Department User Permission</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-sm-6 float-sm-left">
                                <h3 class="card-title"><?php echo $mode; ?> Department User Permission</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="departmentUser-master" method="post" action="<?php echo base_url();?>admin/department_user/permission" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : Company Details -->
                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Module Name</th>
                                                    <th>Add Record Permission</th>
                                                    <th>Edit Record Permission</th>
                                                    <th>Delete Record Permission</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" id="module_name" name="module_name" value="Department Master" readonly="">
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" name="palletising_comply" id="palletising_ncr" type="checkbox">
                                                            <label class="custom-control-label" for="palletising_comply"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" name="palletising_comply" id="palletising_ncr" type="checkbox">
                                                            <label class="custom-control-label" for="palletising_comply"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" name="palletising_comply" id="palletising_ncr" type="checkbox">
                                                            <label class="custom-control-label" for="palletising_comply"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End : Company Details -->
                                <div class="box-footer">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<style>
    .error {
        color: red;
    }
</style>
<script>
    $(document).ready(function() {
    $('.select2').select2();
        $(function() {

            // Setup form validation on the #register-form element
            $("#departmentUser-master").validate({
                // Specify the validation rules
                rules: {
                    user_name: "required",
                    user_name: {
                        required: true,
                        minlength: 6,
                    },
                    role: "required",
                    contact_number: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    password: {
                        <?php if ($mode == "Add") { ?>
                            required: true,
                        <?php } ?>
                        minlength: 6
                    },
                    confirm_password: {
                        equalTo: "#password",
                    },
                },

                // Specify the validation error messages
                messages: {
                    user_name: {
                        required: "Please enter a user name",
                        minlength: "Please enter minimum 6 latters",
                    },
                    role: "Please enter role",
                    contact_number: {
                        required: "Enter Contact Number",
                        number: "Enter only number",
                        maxlength: "Please enter maximum 10 latters in Number",
                        minlength: "Please enter minimum 10 latters in Number",
                    },
                    password: {
                        required: "Please enter a valid password",
                        minlength: "Your password must be at least 6 characters long",
                    },
                    confirm_password: {
                        equalTo: "Passwords do not match."
                    },
                }

            });

        });
    });
</script>