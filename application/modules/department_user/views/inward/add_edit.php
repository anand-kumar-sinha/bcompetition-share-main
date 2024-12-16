<?php
if (isset($InwardDetail)) {
    $id = $InwardDetail->id;
    $inward_date = date("m/d/Y", strtotime($InwardDetail->inward_date));
    $gate_entry_no = $InwardDetail->gate_entry_no;
    $vehicle_no = $InwardDetail->vehicle_no;
    $supplier_id = $InwardDetail->supplier_id;
    $supplier_invoice_no = $InwardDetail->supplier_invoice_no;
    $group = $InwardDetail->group;
    $mode          = 'Edit';
} else {
    $id = '';
    $inward_date = '';
    $gate_entry_no = '';
    $vehicle_no = '';
    $supplier_id = '';
    $supplier_invoice_no = '';
    $group = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/inward">Inward List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Inward</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Inward</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="inward-form" method="post" action="<?php echo base_url(); ?>department_user/inward/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : Company Details -->
                                <input type="hidden" id="id" name="id" value="<?= $id; ?>">
                                <!-- Start ROW -->
                                <div class="row">
                                    <label>Inward Details</label>
                                </div>
                                <hr>
                                <!-- End ROW -->
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gate entry No</label>
                                            <input type="text" class="form-control" id="gate_entry_no" name="gate_entry_no" value="<?= $gate_entry_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control date" id="inward_date" name="inward_date" value="<?= $inward_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Vehicle No</label>
                                            <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" value="<?= $vehicle_no; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Supplier Name</label>
                                            <select name="supplier_id" class="custom-select select2">
                                                <?php foreach ($AllSupplier as $_AllSupplier) { ?>
                                                    <option value="<?php echo $_AllSupplier->id; ?>" <?php if ($_AllSupplier->id == $supplier_id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo $_AllSupplier->supplier_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Supplier Invoice/Challan No</label>
                                            <input type="text" class="form-control" id="supplier_invoice_no" name="supplier_invoice_no" value="<?= $supplier_invoice_no; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Group</label>
                                            <select name="group" class="custom-select" onchange="HideShowField(this.value);">
                                                <option value="">Select</option>
                                                <option value="R.M" <?php if ($group == 'R.M') {
                                                                        echo 'selected';
                                                                    } ?>>R.M</option>
                                                <option value="Store" <?php if ($group == 'Store') {
                                                                            echo 'selected';
                                                                        } ?>>Store</option>
                                                <option value="Mother Sheet" <?php if ($group == 'Mother Sheet') {
                                                                                    echo 'selected';
                                                                                } ?>>Mother Sheet</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->




                                <!-- START RM -->
                                <div id="rm_div">
                                    <input type="hidden" id="attribute_row_count" value="1">
                                    <div class="newRmDetailClass" id="newRmDetailDiv">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <hr>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-primary btn-sm" onclick="AddDiv('rm_div');"><span class="fa fa-plus"></span></span>
                                            </div>
                                        </div>
                                        <div class="rm_div_details">
                                            <!-- Start ROW -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label>Material Description / Size</label>
                                                        <select name="bom_part_detail_id[]" class="custom-select select2">
                                                            <?php foreach ($AllBom as $_AllBom) { ?>
                                                                <option value="<?php echo $_AllBom->bom_part_detail_id; ?>"><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Qty</label>
                                                        <input type="text" class="form-control" id="qty" name="qty[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Unit</label>
                                                        <select name="unit[]" class="custom-select">
                                                            <option value="Kg">Kg</option>
                                                            <option value="Liter">Liter</option>
                                                            <option value="Meter">Meter</option>
                                                            <option value="Pcs">Pcs</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End ROW -->
                                            <!-- Start ROW -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Rate</label>
                                                        <input type="text" class="form-control" id="rate" name="rate[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="text" class="form-control" id="amount" name="amount[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label>Billing party Invoice No</label>
                                                        <input type="text" class="form-control" id="billing_party_invoice_no" name="billing_party_invoice_no[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End ROW -->
                                            <!-- Start ROW -->
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label>Billing Date</label>
                                                        <input type="text" class="form-control date" id="billing_date" name="billing_date[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ms_field">
                                                    <div class="form-group">
                                                        <label>Ref Part No</label>
                                                        <input type="text" class="form-control" id="ref_part_no" name="ref_part_no[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ms_field">
                                                    <div class="form-group">
                                                        <label>Qty Of Pcs</label>
                                                        <input type="text" class="form-control" id="qty_of_pcs" name="qty_of_pcs[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End ROW -->
                                            <!-- Start ROW -->
                                            <div class="row">

                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label>Batch No</label>
                                                        <input type="text" class="form-control" id="batch_no" name="batch_no[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ms_field">
                                                    <div class="form-group">
                                                        <label>R.M Rate Per Pices</label>
                                                        <input type="text" class="form-control" id="rm_rate_per_pices" name="rm_rate_per_pices[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End ROW -->
                                            <!-- Start ROW -->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Remark</label>
                                                        <input type="text" class="form-control" id="remark" name="remark[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End ROW -->
                                        </div>
                                    </div>
                                </div>
                                <!-- END RM  -->


                                <!-- START STORE -->
                                <div id="store_div" style="display: none;">
                                    <input type="hidden" id="attribute_row_count_store" value="1">
                                    <div class="newStoreDetailClass" id="newStoreDetailDiv">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <hr>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-primary btn-sm" onclick="AddDiv('store_div');"><span class="fa fa-plus"></span></span>
                                            </div>
                                        </div>
                                        <div class="store_div_details">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label>Material Description / Size</label>
                                                        <select name="store_bom_part_detail_id[]" class="custom-select select2">
                                                            <?php foreach ($AllBom as $_AllBom) { ?>
                                                                <option value="<?php echo $_AllBom->bom_part_detail_id; ?>"><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Qty</label>
                                                        <input type="text" class="form-control" id="store_qty" name="store_qty[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Unit</label>
                                                        <select name="store_unit[]" class="custom-select">
                                                            <option value="Kg">Kg</option>
                                                            <option value="Liter">Liter</option>
                                                            <option value="Meter">Meter</option>
                                                            <option value="Pcs">Pcs</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Rate</label>
                                                        <input type="text" class="form-control" id="store_rate" name="store_rate[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="text" class="form-control" id="store_amount" name="store_amount[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Remark</label>
                                                        <input type="text" class="form-control" id="store_remark" name="store_remark[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END STORE  -->


                                <!-- START MOTHER SHEET -->
                                <div id="mother_sheet_div" style="display: none;">
                                    <input type="hidden" id="attribute_row_count_mother_sheet" value="1">
                                    <div class="newMotherSheetDetailClass" id="newMotherSheetDetailDiv">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <hr>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-primary btn-sm" onclick="AddDiv('mother_sheet_div');"><span class="fa fa-plus"></span></span>
                                            </div>
                                        </div>
                                        <div class="mother_sheet_div_details">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label>Material Description / Size</label>
                                                        <select name="mother_sheet_bom_part_detail_id[]" class="custom-select select2">
                                                            <?php foreach ($AllBom as $_AllBom) { ?>
                                                                <option value="<?php echo $_AllBom->bom_part_detail_id; ?>"><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Qty</label>
                                                        <input type="text" class="form-control" id="mother_sheet_qty" name="mother_sheet_qty[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Unit</label>
                                                        <select name="mother_sheet_unit[]" class="custom-select">
                                                            <option value="Kg">Kg</option>
                                                            <option value="Liter">Liter</option>
                                                            <option value="Meter">Meter</option>
                                                            <option value="Pcs">Pcs</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Rate</label>
                                                        <input type="text" class="form-control" id="mother_sheet_rate" name="mother_sheet_rate[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Amount</label>
                                                        <input type="text" class="form-control" id="mother_sheet_amount" name="mother_sheet_amount[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label>Billing party Invoice No</label>
                                                        <input type="text" class="form-control" id="mother_sheet_billing_party_invoice_no" name="mother_sheet_billing_party_invoice_no[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label>Billing Date</label>
                                                        <input type="text" class="form-control date" id="mother_sheet_billing_date" name="mother_sheet_billing_date[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <div class="form-group">
                                                        <label>Batch No</label>
                                                        <input type="text" class="form-control" id="mother_sheet_batch_no" name="mother_sheet_batch_no[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Remark</label>
                                                        <input type="text" class="form-control" id="mother_sheet_remark" name="mother_sheet_remark[]" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MOTHER SHEET  -->


                                <!-- End : Company Details -->
                                <div class="box-footer">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <?php if ($mode == "Edit") { ?>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Inward Sub Details</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Material Description / Size</th>
                                                    <th>Qty</th>
                                                    <th>Unit</th>
                                                    <th>Amount</th>
                                                    <th>Billing party Invoice No</th>
                                                    <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                                </tr>
                                            </thead>
                                            <?php foreach ($AllInwardSubDetail as $AllInwardSubDetail) { ?>
                                                <tr>
                                                    <td><?php echo $AllInwardSubDetail->bom_number . '##' . $AllInwardSubDetail->part_name . '/' . $AllInwardSubDetail->part_code . '##' . $AllInwardSubDetail->rm_form . '##' . $AllInwardSubDetail->rm_size; ?></td>
                                                    <td><?php echo $AllInwardSubDetail->qty; ?></td>
                                                    <td><?php echo $AllInwardSubDetail->unit; ?></td>
                                                    <td><?php echo $AllInwardSubDetail->amount; ?></td>
                                                    <td><?php echo $AllInwardSubDetail->billing_party_invoice_no; ?></td>
                                                    <td class="no-sort center-text-table">
                                                        <button class="btn btn-primary btn-xs" onclick="EditInwardSubDetail(<?php echo $AllInwardSubDetail->id; ?>);"><i class="fas fa-edit"></i></button>
                                                        <a href="<?php echo base_url() . 'department_user/inward/InwardSubdelete/' . $AllInwardSubDetail->id . '/' . $id; ?>" onclick="return confirm('Are you sure?');">
                                                            <button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>
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

<div id="InwardSubDetailDivPopup"></div>
<style>
    .error {
        color: red;
    }
</style>
<script>
    function HideShowField(group_name) {
        if (group_name == "Store") {
            $("#mother_sheet_div").hide();
            $("#rm_div").hide();
            $("#store_div").show();
        } else if (group_name == "Mother Sheet") {
            $("#mother_sheet_div").show();
            $("#rm_div").hide();
            $("#store_div").hide();
        } else {
            $("#mother_sheet_div").hide();
            $("#rm_div").show();
            $("#store_div").hide();
        }
    }

    function AddDiv(id) {
        if (id == 'store_div') {
            console.log('monika -----store_div')
            var tmp = 1;
            var numItems = $('#attribute_row_count_store').val();
            $('#attribute_row_count_store').val(parseInt(numItems) + parseInt(tmp));
            var html = '';
            html += '<div class="newStoreDetailClass" id="newStoreDetailDiv' + numItems + '">';
            html += '<div class="row">';
            html += '<div class="col-md-11">';
            html += '<hr>';
            html += '</div>';
            html += '<div class="col-md-1">';
            html += '<span class="btn btn-danger btn-sm" onclick="StoreDetailDiv(' + numItems + ');"><span class="fa fa-minus"></span></span>';
            html += '</div>';
            html += '</div>';
            html += '<div class="store_div_details">';
            html += '<div class="row">';
            html += '<div class="col-md-4">';
            html += '<div class="form-group ">';
            html += '<label>Material Description / Size</label>';
            html += '<select name="store_bom_part_detail_id[]" class="custom-select select2">';
            <?php foreach ($AllBom as $_AllBom) { ?>
                html += '<option value="<?php echo $_AllBom->bom_part_detail_id; ?>"><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>';
            <?php } ?>
            html += '</select>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Qty</label>';
            html += '<input type="text" class="form-control" id="store_qty" name="store_qty[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Unit</label>';
            html += '<select name="store_unit[]" class="custom-select">';
            html += '<option value="Kg">Kg</option>';
            html += '<option value="Liter">Liter</option>';
            html += '<option value="Meter">Meter</option>';
            html += '<option value="Pcs">Pcs</option>';
            html += '</select>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Rate</label>';
            html += '<input type="text" class="form-control" id="store_rate" name="store_rate[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Amount</label>';
            html += '<input type="text" class="form-control" id="store_amount" name="store_amount[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-8">';
            html += '<div class="form-group">';
            html += '<label>Remark</label>';
            html += '<input type="text" class="form-control" id="store_remark" name="store_remark[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            $('#' + id).append(html);
        } else if (id == 'mother_sheet_div') {
            var tmp = 1;
            var numItems = $('#attribute_row_count_mother_sheet').val();
            $('#attribute_row_count_mother_sheet').val(parseInt(numItems) + parseInt(tmp));
            console.log(numItems)
            var html = '';
            html += '<div class="newMotherSheetDetailClass" id="newMotherSheetDetailDiv' + numItems + '">';
            html += '<div class="row">';
            html += '<div class="col-md-11">';
            html += '<hr>';
            html += '</div>';
            html += '<div class="col-md-1">';
            html += '<span class="btn btn-danger btn-sm" onclick="MotherSheetDetailDiv(' + numItems + ');"><span class="fa fa-minus"></span></span>';
            html += '</div>';
            html += '</div>';
            html += '<div class="mother_sheet_div_details">';
            html += '<div class="row">';
            html += '<div class="col-md-4">';
            html += '<div class="form-group ">';
            html += '<label>Material Description / Size</label>';
            html += '<select name="mother_sheet_bom_part_detail_id[]" class="custom-select select2">';
            <?php foreach ($AllBom as $_AllBom) { ?>
                html += '<option value="<?php echo $_AllBom->bom_part_detail_id; ?>"><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>';
            <?php } ?>
            html += '</select>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Qty</label>';
            html += '<input type="text" class="form-control" id="mother_sheet_qty" name="mother_sheet_qty[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Unit</label>';
            html += '<select name="mother_sheet_unit[]" class="custom-select">';
            html += '<option value="Kg">Kg</option>';
            html += '<option value="Liter">Liter</option>';
            html += '<option value="Meter">Meter</option>';
            html += '<option value="Pcs">Pcs</option>';
            html += '</select>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Rate</label>';
            html += '<input type="text" class="form-control" id="mother_sheet_rate" name="mother_sheet_rate[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Amount</label>';
            html += '<input type="text" class="form-control" id="mother_sheet_amount" name="mother_sheet_amount[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4 ">';
            html += '<div class="form-group">';
            html += '<label>Billing party Invoice No</label>';
            html += '<input type="text" class="form-control" id="mother_sheet_billing_party_invoice_no" name="mother_sheet_billing_party_invoice_no[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-4 ">';
            html += '<div class="form-group">';
            html += '<label>Billing Date</label>';
            html += '<input type="text" class="form-control date" id="mother_sheet_billing_date" name="mother_sheet_billing_date[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4 ">';
            html += '<div class="form-group">';
            html += '<label>Batch No</label>';
            html += '<input type="text" class="form-control" id="mother_sheet_batch_no" name="mother_sheet_batch_no[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-8">';
            html += '<div class="form-group">';
            html += '<label>Remark</label>';
            html += '<input type="text" class="form-control" id="mother_sheet_remark" name="mother_sheet_remark[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            $('#' + id).append(html);
        } else {
            var tmp = 1;
            var numItems = $('#attribute_row_count').val();
            $('#attribute_row_count').val(parseInt(numItems) + parseInt(tmp));
            console.log(numItems)
            var html = '';
            html += '<div class="newRmDetailClass" id="newRmDetailDiv' + numItems + '">';
            html += '<div class="row">';
            html += '<div class="col-md-11">';
            html += '<hr>';
            html += '</div>';
            html += '<div class="col-md-1">';
            html += '<span class="btn btn-danger btn-sm" onclick="RmDetailDiv(' + numItems + ');"><span class="fa fa-minus"></span></span>';
            html += '</div>';
            html += '</div>';
            // html += $('.' + id + '_details').html();
            html += '<div class="rm_div_details">';
            html += '<div class="row">';
            html += '<div class="col-md-4">';
            html += '<div class="form-group ">';
            html += '<label>Material Description / Size</label>';
            html += '<select name="bom_part_detail_id[]" class="custom-select select2">';
            <?php foreach ($AllBom as $_AllBom) { ?>
                html += '<option value="<?php echo $_AllBom->bom_part_detail_id; ?>"><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>';
            <?php } ?>
            html += '</select>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Qty</label>';
            html += '<input type="text" class="form-control" id="qty" name="qty[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Unit</label>';
            html += '<select name="unit[]" class="custom-select">';
            html += '<option value="Kg">Kg</option>';
            html += '<option value="Liter">Liter</option>';
            html += '<option value="Meter">Meter</option>';
            html += '<option value="Pcs">Pcs</option>';
            html += '</select>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            html += '<div class="row">';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Rate</label>';
            html += '<input type="text" class="form-control" id="rate" name="rate[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label>Amount</label>';
            html += '<input type="text" class="form-control" id="amount" name="amount[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4 ">';
            html += '<div class="form-group">';
            html += '<label>Billing party Invoice No</label>';
            html += '<input type="text" class="form-control" id="billing_party_invoice_no" name="billing_party_invoice_no[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-4 ">';
            html += '<div class="form-group">';
            html += '<label>Billing Date</label>';
            html += '<input type="text" class="form-control date" id="billing_date" name="billing_date[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4 ms_field">';
            html += '<div class="form-group">';
            html += '<label>Ref Part No</label>';
            html += '<input type="text" class="form-control" id="ref_part_no" name="ref_part_no[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4 ms_field">';
            html += '<div class="form-group">';
            html += '<label>Qty Of Pcs</label>';
            html += '<input type="text" class="form-control" id="qty_of_pcs" name="qty_of_pcs[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-4 ">';
            html += '<div class="form-group">';
            html += '<label>Batch No</label>';
            html += '<input type="text" class="form-control" id="batch_no" name="batch_no[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-md-4 ms_field">';
            html += '<div class="form-group">';
            html += '<label>R.M Rate Per Pices</label>';
            html += '<input type="text" class="form-control" id="rm_rate_per_pices" name="rm_rate_per_pices[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-8">';
            html += '<div class="form-group">';
            html += '<label>Remark</label>';
            html += '<input type="text" class="form-control" id="remark" name="remark[]" value="">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            $('#' + id).append(html);
        }
        $('.date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'), 10)
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
        });
    }

    function RmDetailDiv(attribute_row_count) {
        var numItems = $('#attribute_row_count').val();
        $('#attribute_row_count').val(parseInt(numItems) - parseInt(1));
        $('#newRmDetailDiv' + attribute_row_count).remove();
    }

    function StoreDetailDiv(attribute_row_count_store) {
        var numItems = $('#attribute_row_count_store').val();
        $('#attribute_row_count_store').val(parseInt(numItems) - parseInt(1));
        $('#newStoreDetailDiv' + attribute_row_count_store).remove();
    }

    function MotherSheetDetailDiv(attribute_row_count_mother_sheet) {
        var numItems = $('#attribute_row_count_mother_sheet').val();
        $('#attribute_row_count_mother_sheet').val(parseInt(numItems) - parseInt(1));
        $('#newMotherSheetDetailDiv' + attribute_row_count_mother_sheet).remove();
    }
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        HideShowField('<?php echo $group ?>')
        $(function() {

            // Setup form validation on the #register-form element
            $("#inward-form").validate({
                // Specify the validation rules
                rules: {
                    inward_date: "required",
                    gate_entry_no: "required",
                    vehicle_no: "required",
                    supplier_id: "required",
                    supplier_invoice_no: "required",
                    group: "required"
                },

                // Specify the validation error messages
                messages: {
                    inward_date: "Please select a date",
                    gate_entry_no: "Please enter gate entry no",
                    vehicle_no: "Please enter vehicle no",
                    supplier_id: "Please enter supplier name",
                    supplier_invoice_no: "Please enter supplier invoice no",
                    group: "required"
                }

            });

        });
    });

    $(function() {
        $('.date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'), 10)
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
        });
    });

    function EditInwardSubDetail(inward_sub_id) {
        $.ajax({
            url: "<?php echo base_url() . "department_user/inward/edit_inward_sub_detail"; ?>",
            method: "POST",
            data: {
                inward_sub_id: inward_sub_id
            },
            success: function(data) {
                $('#InwardSubDetailDivPopup').html(data);
                $('#InwardSubDetailDivModal').modal('show');
            }
        });
    }
</script>