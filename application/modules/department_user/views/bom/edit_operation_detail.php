<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="OperationDetailDivModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Operation Detail</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>department_user/BOM/opration_detail_action" enctype="multipart/form-data" novalidate="novalidate">
                <input type="hidden" name="id" value="<?php echo $BOMOperationDetail->id;?>">
                <input type="hidden" name="bom_id" value="<?php echo $BOMOperationDetail->bom_id;?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Operation Name</label><br>
                                <select name="operation_id" class="custom-select select2" style="width: 100%">
                                    <?php foreach ($AllOperation as $_AllOperation) {
                                        $selected = "";
                                        if ($_AllOperation->id == $BOMOperationDetail->operation_id) {
                                            $selected = "selected";
                                        }
                                    ?>
                                        <option value="<?php echo $_AllOperation->id; ?>" <?php echo $selected; ?>><?php echo $_AllOperation->operation_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Machine</label><br>
                                <select name="machine_id" class="custom-select select2" style="width: 100%">
                                    <?php foreach ($AllMachine as $_AllMachine) {
                                        $selected = "";
                                        if ($_AllMachine->id == $BOMOperationDetail->machine_id) {
                                            $selected = "selected";
                                        }
                                    ?>
                                        <option value="<?php echo $_AllMachine->id; ?>" <?php echo $selected; ?>><?php echo $_AllMachine->machine_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>SPM</label>
                                <input type="text" class="form-control" id="spm_name" name="spm_name" value="<?php echo $BOMOperationDetail->spm_name;?>">
                            </div>
                        </div>
                    </div>
                    <div id="OperationInspectionDiv">
                        <input type="hidden" id="OperationInspection_count" value="<?php echo count($BOMOperationInspectionDetail);?>">
                        <?php $Unique_I=0; foreach ($BOMOperationInspectionDetail as $_BOMOperationInspectionDetail) { $Unique_I++;?>
                        <div class="row" id="OperationInspectionRow_<?php echo $Unique_I;?>">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php  if($Unique_I == 1) {?><label>Inspection Para.</label><?php } ?>
                                    <input type="text" class="form-control" id="inspection_para" name="inspection_para[]" value="<?php echo $_BOMOperationInspectionDetail->inspection_para;?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php  if($Unique_I == 1) {?><label>Specification</label><?php } ?>
                                    <input type="text" class="form-control" id="specification" name="specification[]" value="<?php echo $_BOMOperationInspectionDetail->specification;?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php  if($Unique_I == 1) {?><label>Inspection Method</label><?php } ?>
                                    <input type="text" class="form-control" id="inspection_method" name="inspection_method[]" value="<?php echo $_BOMOperationInspectionDetail->inspection_method;?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php  if($Unique_I == 1) {?><label>Operation cost</label><?php } ?>
                                    <input type="text" class="form-control" id="operation_cost" name="operation_cost[]" value="<?php echo $_BOMOperationInspectionDetail->operation_cost;?>">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <?php  if($Unique_I == 1) {?>
                                <br>
                                <span class="btn btn-primary btn-sm" onclick="AddOperationInspection();"><span class="fa fa-plus"></span></span>
                                <?php } else {?>
                                <span class="btn btn-danger btn-sm" onclick="RemoveOperationInspectionDiv(<?php echo $Unique_I;?>);"><span class="fa fa-minus"></span></span>
                                <?php }?>
                            </div>
                        </div>
                        <?php } ?>
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
    $('.select2').select2();
    
    function AddOperationInspection() {
        
        var OperationInspection_countTemp = $('#OperationInspection_count').val();
        var OperationInspection_count = parseInt(OperationInspection_countTemp) + 1;
        $('#OperationInspection_count').val(OperationInspection_count);
        var html = '';
        html += '<div class="row" id="OperationInspectionRow_' + OperationInspection_count + '">';
            html += '<div class="col-md-3"> ';
                html += '<div class="form-group">';
                    html += '<input type="text" class="form-control" id="inspection_para" name="inspection_para[]" value="">';
                html += '</div>';
            html += '</div>';
            html += '<div class="col-md-2"> ';
                html += '<div class="form-group">';
                    html += '<input type="text" class="form-control" id="specification" name="specification[]" value="">';
                html += '</div>';
            html += '</div>';
            html += '<div class="col-md-3"> ';
                html += '<div class="form-group">';
                    html += '<input type="text" class="form-control" id="inspection_method" name="inspection_method[]" value="">';
                html += '</div>';
            html += '</div>';
            html += '<div class="col-md-2"> ';
                html += '<div class="form-group">';
                    html += '<input type="text" class="form-control" id="operation_cost" name="operation_cost[]" value="">';
                html += '</div>';
            html += '</div>';
            html += '<div class="col-md-1"> ';
                html += '<span class="btn btn-danger btn-sm" onclick="RemoveOperationInspectionDiv(' + OperationInspection_count + ');"><span class="fa fa-minus"></span></span>';
            html += '</div>';
        html += '</div>';
        $('#OperationInspectionDiv').append(html);
    }
    
    function RemoveOperationInspectionDiv(attribute_row_count) {
        $('#OperationInspectionRow_' + attribute_row_count).remove();
    }
    
</script>