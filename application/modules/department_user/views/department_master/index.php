
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Dashboard">Dashboard</a></li>
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
                                <h3 class="card-title">Department List</h3>
                            </div>
                            <div class="col-sm-6 float-sm-right right-add">
                                <a class="top-btn right-button" href="<?php echo base_url() . 'department_user/department_master/add_edit/'; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
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
                                        <th style="width: 10%;">Status</th>
                                        <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <?php foreach ($AllDepartment as $_AllDepartment) { 
                                        if($_AllDepartment->status == "Active"){
                                            $btnClass = "btn-success";
                                        }else{
                                            $btnClass = "btn-danger";
                                        }
                                        
                                    ?>
                                    <tr>
                                        <td><?php echo $_AllDepartment->department_name; ?></td>
                                         <td> 
                                            <button class="btn btn-block btn-xs <?php echo $btnClass; ?>"><?php echo $_AllDepartment->status; ?></button>
                                        </td>
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'department_user/department_master/add_edit/' . $_AllDepartment->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'department_user/department_master/delete/'.$_AllDepartment->id; ?>" onclick="return confirm('Are you sure?');">
                                                <button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                                            </a>
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
