
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dispatch List</li>
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
                                <h3 class="card-title">Dispatch List</h3>
                            </div>
                            <div class="col-sm-6 float-sm-right right-add">
                                <a class="top-btn right-button" href="<?php echo base_url() . 'department_user/dispatch/add_edit/'; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                    <button class="btn btn-primary btn-xs"><span class="fa fa-plus-circle"></span> Add</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Dispatch Date</th>
                                        <th>Ship To</th>
                                        <th>Vehicle Number</th> 
                                        <th>Customer Details</th> 
                                        <th>Part Name / Code</th> 
                                        <th>Qty / Unit</th> 
                                        <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <?php foreach ($AlldispatchList as $_AlldispatchList) { ?>
                                    <tr>
                                        <td><?php echo date("d-m-Y", strtotime($_AlldispatchList->dispatch_date)); ?></td>
                                        <td><?php echo $_AlldispatchList->ship_to; ?></td>
                                        <td><?php echo $_AlldispatchList->vehicle_number; ?></td>
                                        <td><?php $br = ''; foreach($_AlldispatchList->dispatch_detail as $value) {
                                                echo $br.$value->customer_name.'('.$value->contact.')';
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td><?php $br = ''; foreach($_AlldispatchList->dispatch_detail as $value) {
                                                echo $br.$value->part_name.'/'.$value->part_code;
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td><?php $br = ''; foreach($_AlldispatchList->dispatch_detail as $value) {
                                                echo $br.$value->qty.'/'.$value->unit;
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'department_user/dispatch/add_edit/' . $_AlldispatchList->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'department_user/dispatch/delete/'.$_AlldispatchList->id; ?>" onclick="return confirm('Are you sure?');">
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
