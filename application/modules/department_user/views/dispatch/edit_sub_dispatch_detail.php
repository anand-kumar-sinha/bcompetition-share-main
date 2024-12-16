<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="OperationDetailDivModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Dispatch Sub Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>department_user/dispatch/dispatch_sub_detail_action" enctype="multipart/form-data" novalidate="novalidate">
                    <input type="hidden" name="id" value="<?php echo $DispatchDetailData->id; ?>">
                    <input type="hidden" name="dispatch_id" value="<?php echo $DispatchDetailData->dispatch_id; ?>">

                    <div id="dispatch_sub_default_div">
                        <input type="hidden" id="rm_form_sub_attribute_row_count" value="1">
                        <!-- Start ROW -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <select name="customer_id[]" class="custom-select">
                                        <?php foreach ($AllCustomer as $_AllCustomer) { ?>
                                            <option value="<?php echo $_AllCustomer->id; ?>" <?php if($DispatchDetailData->customer_id == $_AllCustomer->id){ echo 'selected';}?>><?php echo $_AllCustomer->customer_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>P.O No / Part Name</label>
                                    <select name="po_part_id[]" class="custom-select">
                                        <?php foreach ($AllPart as $_AllPart) { ?>
                                            <option value="<?php echo $_AllPart->id; ?>" <?php if($DispatchDetailData->po_part_id == $_AllPart->id){ echo 'selected';}?>><?php echo $_AllPart->part_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Part Number</label>
                                    <select name="part_id[]" class="custom-select">
                                        <?php foreach ($AllPart as $_AllPart) { ?>
                                            <option value="<?php echo $_AllPart->id; ?>" <?php if($DispatchDetailData->part_id == $_AllPart->id){ echo 'selected';}?>><?php echo $_AllPart->part_code; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-1">
                                <label>&nbsp;</label><br>
                                <span class="btn btn-primary btn-sm" onclick="AddDispatchSubDiv();"><span class="fa fa-plus"></span></span>
                            </div> -->
                        </div>
                        <!-- End ROW -->
                        <!-- Start ROW -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>QTY</label>
                                    <input type="text" class="form-control" id="qty" name="qty[]" value="<?= $DispatchDetailData->qty ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" class="form-control" id="unit" name="unit[]" value="<?= $DispatchDetailData->unit ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Authorizes Person</label>
                                    <input type="text" class="form-control" id="authorizes_person" name="authorizes_person[]" value="<?= $DispatchDetailData->authorizes_person ?>">
                                </div>
                            </div>
                        </div>
                        <!-- End ROW -->
                        <!-- Start ROW -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Job Card No</label>
                                    <select name="job_card_id[]" class="custom-select">
                                        <?php foreach ($AllJobCardList as $_AllJobCardList) { ?>
                                            <option value="<?php echo $_AllJobCardList->id; ?>" <?php if($DispatchDetailData->job_card_id == $_AllJobCardList->id){ echo 'selected';}?>> <?php echo $_AllJobCardList->job_card_number; ?> </option>;
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Batch No</label>
                                    <input type="text" class="form-control" id="batch_no" name="batch_no[]" value="<?= $DispatchDetailData->batch_no ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status[]" class="custom-select">
                                        <option value="Active" <?php if($DispatchDetailData->status == 'Active'){ echo 'selected';}?>>Active</option>
                                        <option value="Deactive" <?php if($DispatchDetailData->status == 'Deactive'){ echo 'selected';}?>>Deactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

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
    function AddDispatchSubDiv() {
        console.log('call function')
        var tmp = 1;
        var count = $('#rm_form_sub_attribute_row_count').val();
        $('#rm_form_sub_attribute_row_count').val(parseInt(count) + parseInt(tmp));

        var html = '<div class="row Row_sub_' + count + '">';
        html += '<div class="col-md-3"> ';
        html += '<div class="form-group">';
        html += '<label>Customer Name</label>';
        html += '<select name="customer_id[]" class="custom-select">';
        <?php foreach ($AllCustomer as $_AllCustomer) { ?>
            html += '<option value="<?php echo $_AllCustomer->id; ?> " ><?php echo $_AllCustomer->customer_name; ?> </option>';
        <?php } ?>
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label>P.O No / Part Name</label>';
        html += '<select name="po_part_id[]" class="custom-select">';
        <?php foreach ($AllPart as $_AllPart) { ?>
            html += '<option value="<?php echo $_AllPart->id; ?> " ><?php echo $_AllPart->part_name; ?> </option>';
        <?php } ?>
        html += '</select> ';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label>Part Number</label>';
        html += '<select name="part_id[]" class="custom-select">';
        <?php foreach ($AllPart as $_AllPart) { ?>
            html += '<option value="<?php echo $_AllPart->id; ?> " ><?php echo $_AllPart->part_code; ?> </option>';
        <?php } ?>
        html += '</select> ';
        html += '</div>';
        html += '</div>';
        //            html += '<div class="col-md-3"></div>';
        html += '<div class="col-md-1">';
        html += '<label>&nbsp;</label><br>';
        html += '<span class="btn btn-danger btn-sm" onclick="RemoveDispatchSubDiv(' + count + ');"><span class="fa fa-minus"></span></span>';
        html += '</div>';
        html += '</div>';
        html += '<div class="row Row_' + count + '">';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label>QTY</label>';
        html += '<input type="text" class="form-control" id="qty" name="qty[]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label>Unit</label>';
        html += '<input type="text" class="form-control" id="unit" name="unit[]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label>Authorizes Person</label>';
        html += '<input type="text" class="form-control" id="authorizes_person" name="authorizes_person[]" value="">';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="row Row_' + count + '">';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label>Job Card No</label>';
        html += '<select name="job_card_id[]" class="custom-select">';
        <?php foreach ($AllJobCardList as $_AllJobCardList) { ?>
            html += '<option value="<?php echo $_AllJobCardList->id; ?>" ><?php echo $_AllJobCardList->job_card_number; ?></option>';
        <?php } ?>
        html += '</select> ';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label>Batch No</label>';
        html += '<input type="text" class="form-control" id="batch_no" name="batch_no[]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label>Status</label>';
        html += '<select name="status[]" class="custom-select">';
        html += '<option value="Active">Active</option>';
        html += '<option value="Deactive">Deactive</option>';
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $("#dispatch_sub_default_div").append(html);
    }

    function RemoveDispatchSubDiv(count) {
        $('.Row_sub_' + count).remove();
    }
</script>