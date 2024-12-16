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
                <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>admin/inward/inward_sub_detail_action" enctype="multipart/form-data" novalidate="novalidate">
                    <input type="hidden" name="id" value="<?php echo $InwardSubDetail->id; ?>">
                    <input type="hidden" name="inward_id" value="<?php echo $InwardSubDetail->inward_id; ?>">
                    <!-- START RM -->
                    <div id="rm_sub_div">
                        <input type="hidden" id="attribute_sub_row_count" value="1">
                        <div class="newRmDetailClass" id="newRmDetailSubDiv">
                            <!-- <div class="row">
                                <div class="col-md-11">
                                    <hr>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-primary btn-sm" onclick="AddDiv('rm_sub_div');"><span class="fa fa-plus"></span></span>
                                </div>
                            </div> -->
                            <div class="rm_sub_div_details">
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>Material Description / Size</label>
                                            <select name="material_description" class="custom-select">
                                                <?php foreach ($AllBom as $_AllBom) { ?>
                                                    <option value="<?php echo $_AllBom->bom_number . '##' . $_AllBom->part_name . '##' . $_AllBom->part_code . '##' . $_AllBom->rm_form . '##' . $_AllBom->rm_size; ?>" <?php if($InwardSubDetail->material_description == $_AllBom->bom_number . '##' . $_AllBom->part_name . '##' . $_AllBom->part_code . '##' . $_AllBom->rm_form . '##' . $_AllBom->rm_size){ echo 'selected';} ?>><?php echo $_AllBom->bom_number . ' / ' . $_AllBom->part_name . '/' . $_AllBom->part_code . ' / ' . $_AllBom->rm_form . ' / ' . $_AllBom->rm_size; ?></option>
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
                                            <label>Unit <?php echo $InwardSubDetail->unit?></label>
                                            <select name="unit" class="custom-select">
                                                <option value="Kg" <?php if($InwardSubDetail->unit == 'Kg'){ echo 'selected';} ?>>Kg</option>
                                                <option value="Liter" <?php if($InwardSubDetail->unit == 'Liter'){ echo 'selected';} ?>>Liter</option>
                                                <option value="Meter" <?php if($InwardSubDetail->unit == 'Meter'){ echo 'selected';} ?>>Meter</option>
                                                <option value="Pcs" <?php if($InwardSubDetail->unit == 'Pcs'){ echo 'selected';} ?>>Pcs</option>
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
                                            <input type="text" class="form-control" id="billing_party_invoice_no" name="billing_party_invoice_no" value="<?php echo $InwardSubDetail->billing_party_invoice_no ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label>Billing Date</label>
                                            <input type="text" class="form-control date" id="billing_date" name="billing_date" value="<?php echo date("m/d/Y", strtotime($InwardSubDetail->billing_date)) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ms_field">
                                        <div class="form-group">
                                            <label>Ref Part No</label>
                                            <input type="text" class="form-control" id="ref_part_no" name="ref_part_no" value="<?php echo $InwardSubDetail->ref_part_no ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ms_field">
                                        <div class="form-group">
                                            <label>Qty Of Pcs</label>
                                            <input type="text" class="form-control" id="qty_of_pcs" name="qty_of_pcs" value="<?php echo $InwardSubDetail->qty_of_pcs ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                                <!-- Start ROW -->
                                <div class="row">

                                    <div class="col-md-4 ">
                                        <div class="form-group">
                                            <label>Batch No</label>
                                            <input type="text" class="form-control" id="batch_no" name="batch_no" value="<?php echo $InwardSubDetail->batch_no ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ms_field">
                                        <div class="form-group">
                                            <label>R.M Rate Per Pices</label>
                                            <input type="text" class="form-control" id="rm_rate_per_pices" name="rm_rate_per_pices" value="<?php echo $InwardSubDetail->rm_rate_per_pices ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Remark</label>
                                            <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $InwardSubDetail->remark ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                            </div>
                        </div>
                    </div>
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

    function AddDiv(id) {
        var tmp = 1;
        var numItems = $('#attribute_sub_row_count').val();
        $('#attribute_sub_row_count').val(parseInt(numItems) + parseInt(tmp));
        var html = '';
        html += '<div class="newRmDetailClass" id="newRmDetailSubDiv' + numItems + '">';
        html += '<div class="row">';
        html += '<div class="col-md-11">';
        html += '<hr>';
        html += '</div>';
        html += '<div class="col-md-1">';
        html += '<span class="btn btn-danger btn-sm" onclick="RmDetailDiv(' + numItems + ');"><span class="fa fa-minus"></span></span>';
        html += '</div>';
        html += '</div>';
        html += $('.' + id + '_details').html();
        html += '</div>';
        $('#' + id).append(html);
    }

    function RmDetailDiv(attribute_sub_row_count) {
        var numItems = $('#attribute_sub_row_count').val();
        $('#attribute_sub_row_count').val(parseInt(numItems) - parseInt(1));
        $('#newRmDetailSubDiv' + attribute_sub_row_count).remove();
    }
</script>