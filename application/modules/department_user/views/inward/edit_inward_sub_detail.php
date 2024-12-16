<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="InwardSubDetailDivModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Inward sub Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>department_user/inward/inward_sub_detail_action" enctype="multipart/form-data" novalidate="novalidate">
                    <input type="hidden" name="id" value="<?php echo $InwardSubDetail->id; ?>">
                    <input type="hidden" name="inward_id" value="<?php echo $InwardSubDetail->inward_id; ?>">
                    <input type="hidden" name="group" value="<?php echo $InwardDetail->group ?>">
                    <!-- START RM -->
                    <div id="rm_sub_div">
                        <input type="hidden" id="attribute_sub_row_count" value="1">
                        <div class="newRmDetailClass" id="newRmDetailSubDiv">
                            <div class="rm_sub_div_details">
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Material Description / Size</label>
                                            <select name="bom_part_detail_id" class="custom-select">
                                                <?php foreach ($AllBom as $_AllBom) { ?>
                                                    <option value="<?php echo $_AllBom->bom_part_detail_id; ?>" <?php if ($InwardSubDetail->bom_part_detail_id == $_AllBom->bom_part_detail_id) {
                                                                                                                                                                                                                            echo 'selected';
                                                                                                                                                                                                                        } ?>><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="text" class="form-control" id="qty" name="qty" value="<?php echo $InwardSubDetail->qty ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select name="unit" class="custom-select">
                                                <option value="Kg" <?php if ($InwardSubDetail->unit == 'Kg') {
                                                                        echo 'selected';
                                                                    } ?>>Kg</option>
                                                <option value="Liter" <?php if ($InwardSubDetail->unit == 'Liter') {
                                                                            echo 'selected';
                                                                        } ?>>Liter</option>
                                                <option value="Meter" <?php if ($InwardSubDetail->unit == 'Meter') {
                                                                            echo 'selected';
                                                                        } ?>>Meter</option>
                                                <option value="Pcs" <?php if ($InwardSubDetail->unit == 'Pcs') {
                                                                        echo 'selected';
                                                                    } ?>>Pcs</option>
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
                                            <input type="text" class="form-control" id="rate" name="rate" value="<?php echo $InwardSubDetail->rate ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $InwardSubDetail->amount ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label>Billing party Invoice No</label>
                                            <input type="text" class="form-control" id="billing_party_invoice_no" name="billing_party_invoice_no" value="<?php if(isset($InwardSubDetail->billing_party_invoice_no)){ echo $InwardSubDetail->billing_party_invoice_no; }?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label>Billing Date</label>
                                            <input type="text" class="form-control date" id="billing_date" name="billing_date" value="<?php if(isset($InwardSubDetail->billing_date) && $InwardSubDetail->billing_date != '' && $InwardSubDetail->billing_date !='0000-00-00'){ echo date("m/d/Y", strtotime($InwardSubDetail->billing_date)); }else { echo date('m/d/Y') ; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ms_field">
                                        <div class="form-group">
                                            <label>Ref Part No</label>
                                            <input type="text" class="form-control" id="ref_part_no" name="ref_part_no" value="<?php if(isset($InwardSubDetail->ref_part_no)){ echo $InwardSubDetail->ref_part_no;} ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ms_field">
                                        <div class="form-group">
                                            <label>Qty Of Pcs</label>
                                            <input type="text" class="form-control" id="qty_of_pcs" name="qty_of_pcs" value="<?php if(isset($InwardSubDetail->qty_of_pcs)){ echo $InwardSubDetail->qty_of_pcs; } ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                                <!-- Start ROW -->
                                <div class="row">

                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label>Batch No</label>
                                            <input type="text" class="form-control" id="batch_no" name="batch_no" value="<?php if(isset($InwardSubDetail->batch_no)){ echo $InwardSubDetail->batch_no; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ms_field">
                                        <div class="form-group">
                                            <label>R.M Rate Per Pices</label>
                                            <input type="text" class="form-control" id="rm_rate_per_pices" name="rm_rate_per_pices" value="<?php if(isset($InwardSubDetail->rm_rate_per_pices)){ echo $InwardSubDetail->rm_rate_per_pices; } ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <input type="text" class="form-control" id="remark" name="remark" value="<?php if(isset($InwardSubDetail->remark)){ echo $InwardSubDetail->remark; } ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                            </div>
                        </div>
                    </div>
                    <!-- <div id="store_sub_div" style="display: none;">
                        <input type="hidden" id="attribute_sub__row_count_store" value="1">
                        <div class="newStoreDetailClass" id="newStoreDetailDiv">
                            <div class="store_sub_div_details">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Material Description / Size</label>
                                            <select name="store_bom_part_detail_id" class="custom-select select2">
                                                <?php foreach ($AllBom as $_AllBom) { ?>
                                                    <option value="<?php echo $_AllBom->bom_number . '##' . $_AllBom->part_name . '##' . $_AllBom->part_code . '##' . $_AllBom->rm_form . '##' . $_AllBom->rm_size; ?>" <?php if ($InwardSubDetail->bom_part_detail_id == $_AllBom->bom_number . '##' . $_AllBom->part_name . '##' . $_AllBom->part_code . '##' . $_AllBom->rm_form . '##' . $_AllBom->rm_size) {
                                                                                                                                                                                                                            echo 'selected';
                                                                                                                                                                                                                        } ?>><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="text" class="form-control" id="store_qty" name="store_qty" value="<?php echo $InwardSubDetail->billing_party_invoice_no ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select name="store_unit" class="custom-select">
                                                <option value="Kg" <?php if ($InwardSubDetail->unit == 'Kg') {
                                                                        echo 'selected';
                                                                    } ?>>Kg</option>
                                                <option value="Liter" <?php if ($InwardSubDetail->unit == 'Liter') {
                                                                            echo 'selected';
                                                                        } ?>>Liter</option>
                                                <option value="Meter" <?php if ($InwardSubDetail->unit == 'Meter') {
                                                                            echo 'selected';
                                                                        } ?>>Meter</option>
                                                <option value="Pcs" <?php if ($InwardSubDetail->unit == 'Pcs') {
                                                                        echo 'selected';
                                                                    } ?>>Pcs</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Rate</label>
                                            <input type="text" class="form-control" id="store_rate" name="store_rate" value="<?php echo $InwardSubDetail->billing_party_invoice_no ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" id="store_amount" name="store_amount" value="<?php echo $InwardSubDetail->billing_party_invoice_no ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <input type="text" class="form-control" id="store_remark" name="store_remark" value="<?php echo $InwardSubDetail->billing_party_invoice_no ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="mother_sheet_sub_div" style="display: none;">
                        <input type="hidden" id="attribute_sub_row_count_mother_sheet" value="1">
                        <div class="newMotherSheetDetailClass" id="newMotherSheetDetailDiv">
                            <div class="mother_sheet_sub_div_details">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Material Description / Size</label>
                                            <select name="mother_sheet_bom_part_detail_id" class="custom-select select2">
                                                <?php foreach ($AllBom as $_AllBom) { ?>
                                                    <option value="<?php echo $_AllBom->bom_number . '##' . $_AllBom->part_name . '##' . $_AllBom->part_code . '##' . $_AllBom->rm_form . '##' . $_AllBom->rm_size; ?>" <?php if ($InwardSubDetail->bom_part_detail_id == $_AllBom->bom_number . '##' . $_AllBom->part_name . '##' . $_AllBom->part_code . '##' . $_AllBom->rm_form . '##' . $_AllBom->rm_size) {
                                                                                                                                                                                                                            echo 'selected';
                                                                                                                                                                                                                        } ?>><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="text" class="form-control" id="mother_sheet_qty" name="mother_sheet_qty" value="<?php echo $InwardSubDetail->sheet_qty ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select name="mother_sheet_unit" class="custom-select">
                                                <option value="Kg" <?php if ($InwardSubDetail->unit == 'Kg') {
                                                                        echo 'selected';
                                                                    } ?>>Kg</option>
                                                <option value="Liter" <?php if ($InwardSubDetail->unit == 'Liter') {
                                                                            echo 'selected';
                                                                        } ?>>Liter</option>
                                                <option value="Meter" <?php if ($InwardSubDetail->unit == 'Meter') {
                                                                            echo 'selected';
                                                                        } ?>>Meter</option>
                                                <option value="Pcs" <?php if ($InwardSubDetail->unit == 'Pcs') {
                                                                        echo 'selected';
                                                                    } ?>>Pcs</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Rate</label>
                                            <input type="text" class="form-control" id="mother_sheet_rate" name="mother_sheet_rate" value="<?php echo $InwardSubDetail->rate ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control" id="mother_sheet_amount" name="mother_sheet_amount" value="<?php echo $InwardSubDetail->amount ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label>Billing party Invoice No</label>
                                            <input type="text" class="form-control" id="mother_sheet_billing_party_invoice_no" name="mother_sheet_billing_party_invoice_no" value="<?php echo $InwardSubDetail->billing_party_invoice_no ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label>Billing Date</label>
                                            <input type="text" class="form-control date" id="mother_sheet_billing_date" name="mother_sheet_billing_date" value="<?php echo date("m/d/Y", strtotime($InwardSubDetail->billing_date)) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label>Batch No</label>
                                            <input type="text" class="form-control" id="mother_sheet_batch_no" name="mother_sheet_batch_no" value="<?php echo $InwardSubDetail->batch_no ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <input type="text" class="form-control" id="mother_sheet_remark" name="mother_sheet_remark" value="<?php echo $InwardSubDetail->remark ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- END RM  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    console.log('miika----')
    // var group_name = '<?php echo $InwardDetail->group ?>';
    // if (group_name != '') {
    //     SubHideShowField(group_name)
    // }
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

    // function SubHideShowField(group_name) {
    //     console.log(group_name)
    //     if (group_name == "Store") {
    //         $("#mother_sheet_sub_div").hide();
    //         $("#rm_sub_div").hide();
    //         $("#store_sub_div").show();
    //     } else if (group_name == "Mother Sheet") {
    //         $("#mother_sheet_sub_div").show();
    //         $("#rm_sub_div").hide();
    //         $("#store_sub_div").hide();
    //     } else {
    //         $("#mother_sheet_sub_div").hide();
    //         $("#rm_sub_div").show();
    //         $("#store_sub_div").hide();
    //     }
    // }
</script>