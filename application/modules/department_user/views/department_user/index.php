
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department List</li>
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
                                <h3 class="card-title">Department User List</h3>
                            </div>
                            <div class="col-sm-6 float-sm-right right-add">
                                <a class="top-btn right-button" href="<?php echo base_url() . 'admin/department_user/add_edit/'; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                    <button class="btn btn-primary btn-xs"><span class="fa fa-plus-circle"></span> Add</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Department Name</th>
                                        <th>User Name</th>
                                        <th>Contact Number</th>
                                        <th>Role</th>
                                        <th style="width: 10%;">status</th>
                                        <th style="width: 10%;">Deleted By</th>
                                        <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <?php foreach ($AllDepartmentUser as $_AllDepartmentUser) { 
                                        if($_AllDepartmentUser->status == "Active"){
                                            $btnClass = "btn-success";
                                        }else{
                                            $btnClass = "btn-danger";
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $_AllDepartmentUser->department_name; ?></td>
                                        <td><?php echo $_AllDepartmentUser->user_name; ?></td>
                                        <td><?php echo $_AllDepartmentUser->contact_number; ?></td>
                                        <td><?php echo $_AllDepartmentUser->role; ?></td>
                                         <td> 
                                            <button class="btn btn-block btn-xs <?php echo $btnClass; ?>"><?php echo $_AllDepartmentUser->status; ?></button>
                                        </td>
                                        <td> 
                                           <?php 
                                                if($_AllDepartmentUser->user_type == "company_admin"){
                                                    echo $_AllDepartmentUser->person_name.' (Admin)';
                                                } else {
                                                    echo '';
                                                }
                                           ?>
                                        </td>

                                        <td class="no-sort center-text-table">
                                            <?php  if($_AllDepartmentUser->is_deleted == 0){ ?>
                                            <a href="<?php echo base_url() . 'admin/department_user/add_edit/' . $_AllDepartmentUser->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'admin/department_user/delete/'.$_AllDepartmentUser->id; ?>" onclick="return confirm('Are you sure?');">
                                                <button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                                            </a>
                                            <a href="<?php echo base_url().'admin/department_user/permission/'.$_AllDepartmentUser->id; ?>">
                                                <button class="btn btn-warning btn-xs">Permission</button>
                                            </a>
                                            <?php } else { ?>
                                            <a href="<?php echo base_url().'admin/department_user/restore/'.$_AllDepartmentUser->id; ?>" onclick="return confirm('Are you sure?');">
                                                <button class="btn btn-danger btn-xs">Restore</button>
                                            </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
