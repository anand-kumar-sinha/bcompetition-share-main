
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customer List</li>
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
                                <h3 class="card-title">Customer List</h3>
                            </div>
                            <div class="col-sm-6 float-sm-right right-add">
                                <a class="top-btn right-button" href="<?php echo base_url() . 'department_user/Customer_master/add_edit/'; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                    <button class="btn btn-primary btn-xs"><span class="fa fa-plus-circle"></span> Add</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Customer Code</th>
                                        <th>Customer Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th style="width: 10%;">Status</th>
                                        <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <?php foreach ($AllCustomer as $_AllCustomer) { 
                                        if($_AllCustomer->status == "Active"){
                                            $btnClass = "btn-success";
                                        }else{
                                            $btnClass = "btn-danger";
                                        }
                                    ?>
                                    <tr>
                                        <td style="text-transform: capitalize;"><?php echo $_AllCustomer->customer_code; ?></td>
                                        <td style="text-transform: capitalize;"><?php echo $_AllCustomer->customer_name; ?></td>
                                        <td style="text-transform: capitalize;"><?php echo $_AllCustomer->contact; ?></td>
                                        <td style="text-transform: capitalize;"><?php echo $_AllCustomer->email; ?></td>
                                        <td> 
                                            <button class="btn btn-block btn-xs <?php echo $btnClass; ?>"><?php echo $_AllCustomer->status; ?></button>
                                        </td>
                                    
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'department_user/Customer_master/add_edit/' . $_AllCustomer->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'department_user/Customer_master/delete/'.$_AllCustomer->id; ?>" onclick="return confirm('Are you sure?');">
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
