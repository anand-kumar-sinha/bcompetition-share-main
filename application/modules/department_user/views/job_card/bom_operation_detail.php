<hr>
<div class="row" style="text-align: center;">
    <div class="col-md-12">
        <!-- /.card-header -->
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Operation Name</th>
                    <th>Machine Name</th>
                    <th>Operator name</th>
                    <th>Shift</th>
                    <th>Tool change time</th>
                    <th>Planned Qty</th>
                    <th>Start Time</th>
                    <th>Stop Time</th>
                    <th>Qty produced</th>
                    <th>Remark</th>
                    <th>Lost Hrs</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($BOMOperationDetail as $key =>$_BOMOperationDetail) { ?>
                    <input type="hidden" class="form-control" id="operation_id" name="operation_id[]" value="<?= $_BOMOperationDetail->id ?>">
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $_BOMOperationDetail->operation_name?></td>
                        <td><?= $_BOMOperationDetail->machine_name?></td>
                        <td>
                            <select name="employee_id[]" class="custom-select">
                                <?php foreach ($AllEmployee as $_AllEmployee) { ?>
                                    <option value="<?php echo $_AllEmployee->department_user_id; ?>" <?php if($jobcardoperationData && ($jobcardoperationData[$key]->employee_id == $_AllEmployee->department_user_id)){ echo 'selected';}?> ><?php echo $_AllEmployee->user_name; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" id="shift" name="shift[]" value="<?php if($jobcardoperationData){ echo $jobcardoperationData[$key]->shift; } ?>"></td>
                        <td><input type="text" class="form-control" id="tool_change_time" name="tool_change_time[]" value="<?php if($jobcardoperationData){ echo $jobcardoperationData[$key]->tool_change_time; } ?>"></td>
                        <td><input type="text" class="form-control" id="planned_qty" name="planned_qty[]" value="<?php if($jobcardoperationData){ echo $jobcardoperationData[$key]->planned_qty; } ?>"></td>
                        <td><input type="text" class="form-control" id="start_time" name="start_time[]" value="<?php if($jobcardoperationData){ echo $jobcardoperationData[$key]->start_time; } ?>"></td>
                        <td><input type="text" class="form-control" id="stop_time" name="stop_time[]" value="<?php if($jobcardoperationData){ echo $jobcardoperationData[$key]->stop_time; } ?>"></td>
                        <td><input type="text" class="form-control" id="qty_produced" name="qty_produced[]" value="<?php if($jobcardoperationData){ echo $jobcardoperationData[$key]->qty_produced; } ?>"></td>
                        <td><input type="text" class="form-control" id="remark" name="remark[]" value="<?php if($jobcardoperationData){ echo $jobcardoperationData[$key]->remark; } ?>"></td>
                        <td><input type="text" class="form-control" id="lost_hrs" name="lost_hrs[]" value="<?php if($jobcardoperationData){ echo $jobcardoperationData[$key]->lost_hrs; } ?>"></td>
                    </tr>
                <?php $i++; } ?>
        </table>
    </div>
    <!-- /.card-body -->
</div>