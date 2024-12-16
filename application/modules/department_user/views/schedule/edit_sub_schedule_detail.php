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
                <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>department_user/schedule/schedule_sub_detail_action" enctype="multipart/form-data" novalidate="novalidate">
                    <input type="hidden" name="id" value="<?php echo $scheduleDetailData->id; ?>">
                    <input type="hidden" name="schedule_id" value="<?php echo $scheduleDetailData->schedule_id; ?>">

                    <div id="dispatch_sub_default_div">
                        <input type="hidden" id="rm_form_sub_attribute_row_count" value="1">
                        <!-- Start ROW -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <select name="customer_id[]" class="custom-select">
                                        <?php foreach ($AllCustomer as $_AllCustomer) { ?>
                                            <option value="<?php echo $_AllCustomer->id; ?>" <?php if ($scheduleDetailData->customer_id == $_AllCustomer->id) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $_AllCustomer->customer_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Part Name</label>
                                    <select name="part_name_id[]" class="custom-select">
                                        <?php foreach ($AllPart as $_AllPart) { ?>
                                            <option value="<?php echo $_AllPart->id; ?>" <?php if ($scheduleDetailData->part_name_id == $_AllPart->id) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo $_AllPart->part_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Part Number</label>
                                    <select name="part_code_id[]" class="custom-select">
                                        <?php foreach ($AllPart as $_AllPart) { ?>
                                            <option value="<?php echo $_AllPart->id; ?>" <?php if ($scheduleDetailData->part_code_id == $_AllPart->id) {
                                                                                                echo 'selected';
                                                                                            } ?>><?php echo $_AllPart->part_code; ?></option>
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
                                    <label>Schedule</label>
                                    <input type="text" class="form-control" id="schedule" name="schedule[]" value="<?= $scheduleDetailData->schedule ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Month</label>
                                    <input type="text" class="form-control" id="month" name="month[]" value="<?= $scheduleDetailData->month ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Schedule No/PO No</label>
                                    <input type="text" class="form-control" id="schedule_no" name="schedule_no[]" value="<?= $scheduleDetailData->schedule_no ?>">
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