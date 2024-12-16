
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Inward List</li>
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
                                <h3 class="card-title">Inward List</h3>
                            </div>
                            <div class="col-sm-6 float-sm-right right-add">
                                <a class="top-btn right-button" href="<?php echo base_url() . 'department_user/inward/add_edit/'; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">
                                    <button class="btn btn-primary btn-xs"><span class="fa fa-plus-circle"></span> Add</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                     <tr>
                                        <th>Gate entry No</th>
                                        <th>Vehicle No</th>
                                        <th>Supplier</th>
                                        <th>Challan No</th>
                                        <th>Group</th>
                                        <th>BOM Part Detail</th>
                                        <th>Batch No</th>
                                        <th>Inward Date</th>
                                        <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <?php foreach ($AllInwardList as $_AllInwardList) { ?>
                                    <tr>
                                        <td><?php echo $_AllInwardList->gate_entry_no; ?></td>
                                        <td><?php echo $_AllInwardList->vehicle_no; ?></td>
                                        <td><?php echo $_AllInwardList->supplier_name." (".$_AllInwardList->contact.")"; ?></td>
                                        <td><?php echo $_AllInwardList->supplier_invoice_no; ?></td>
                                        <td><?php echo $_AllInwardList->group; ?></td>
                                        <td><?php $br = ''; foreach($_AllInwardList->inward_details as $value) {
                                                echo $br.$value->bom_number . '##' . $value->part_name . '/' . $value->part_code . '##' . $value->rm_form . '##' . $value->rm_size;;
                                                $br = '<br>';
                                            }?>
                                        </td>
                                        <td><?php $br = ''; foreach($_AllInwardList->inward_details as $value) {
                                                echo $br.$value->batch_no;
                                                $br = '<br>';
                                            }?>
                                        </td>
                                        <td><?php echo date("d-m-Y", strtotime($_AllInwardList->inward_date)); ?></td>
                                        <td class="no-sort center-text-table">
                                            <a href="<?php echo base_url() . 'department_user/inward/add_edit/' . $_AllInwardList->id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                            </a>                                           
                                            <a href="<?php echo base_url().'department_user/inward/delete/'.$_AllInwardList->id; ?>" onclick="return confirm('Are you sure?');">
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
