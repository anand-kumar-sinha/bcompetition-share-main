
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">BOM List</li>
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
                                <h3 class="card-title">BOM List</h3>
                            </div>
                            <div class="col-sm-6 float-sm-right right-add">
                                <a class="top-btn right-button" href="<?php echo base_url() . 'department_user/BOM/add_edit/'; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                    <button class="btn btn-primary btn-xs"><span class="fa fa-plus-circle"></span> Add</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>BOM Number</th>
                                        <th>Customer</th>
                                        <th>Part Name / Code</th>
                                        <th>Material Grade Name</th>
                                        <th>RM Form - RM Size</th>
                                        <th>RM Rate - RM Cost</th>
                                        <th>Operation</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <?php foreach ($AllBOMList as $_AllBOMList) { ?>
                                    <tr>
                                        <td><?php echo $_AllBOMList->bom_number; ?></td>
                                        <td><?php echo $_AllBOMList->customer_name.' ('.$_AllBOMList->contact.')'; ?></td>
                                        <td><?php echo $_AllBOMList->part_name.' / '.$_AllBOMList->part_code; ?></td>
                                        <td><?php echo $_AllBOMList->material_grade_name; ?></td>
                                        <td><?php $br = ''; foreach($_AllBOMList->bom_part_data as $value) {
                                                echo $br.$value->rm_form.' - '.$value->rm_size;
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td><?php $br = ''; foreach($_AllBOMList->bom_part_data as $value) {
                                                echo $br.$value->rm_rate.' - '.$value->rm_cost;
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td><?php $br = ''; foreach($_AllBOMList->BOMOperationDetailNew as $value) {
                                                echo $br.$value->operation_name;
                                                $br = '<hr style="margin: 0;">';
                                            }?>
                                        </td>
                                        <td><?php echo $_AllBOMList->status; ?></td>
                                        <td><?php echo date("d-m-Y",strtotime($_AllBOMList->created)); ?></td>
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'department_user/BOM/add_edit/' . $_AllBOMList->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'department_user/BOM/delete/'.$_AllBOMList->id; ?>" onclick="return confirm('Are you sure?');">
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
