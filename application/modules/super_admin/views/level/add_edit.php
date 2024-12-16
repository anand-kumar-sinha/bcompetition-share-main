<?php
if (isset($BOMDetail)) {
    $id = $BOMDetail->id;
    $part_cost = $BOMDetail->part_cost;
    $part_id = $BOMDetail->part_id;
    $customer_id = $BOMDetail->customer_id;
    $material_grade_id = $BOMDetail->material_grade_id;
    $status = $BOMDetail->status;
    $BOMPartDetail = $BOMDetail->BOMPartDetail;
    $BOMOperationDetail = $BOMDetail->BOMOperationDetail;
    $mode          = 'Edit';
} else {
    $id = '';
    $part_cost = '';
    $part_id = '';
    $customer_id = '';
    $material_grade_id = '';
    $status = '';
    $BOMPartDetail = '';
    $BOMOperationDetail = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/BOM">BOM List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> BOM</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> BOM</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>admin/BOM/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                                <!-- Start ROW -->
                                <div class="row" style="text-align: center;">
                                    <div class="col-md-12">
                                        <label>Part Detail</label>
                                    </div>
                                </div>
                                <hr>

                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <select name="customer_id" id="customer_id" class="custom-select select2" onchange="GetCustomerPartAndCode();">
                                                <?php foreach ($AllCustomer as $_AllCustomer) {
                                                    $selected = "";
                                                    if ($_AllCustomer->id == $customer_id) {
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?php echo $_AllCustomer->id; ?>" <?php echo $selected; ?>><?php echo $_AllCustomer->customer_name.' ('.$_AllCustomer->contact.')'; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Part Name / Part Code </label>
                                            <select id="part_id" name="part_id" class="custom-select select2">
                                                <option value=""> -- Select --</option>
                                                <?php /*foreach ($AllPartMaster as $_AllPartMaster) {
                                                    $selected = "";
                                                    if ($_AllPartMaster->id == $part_id) {
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?php echo $_AllPartMaster->id; ?>" <?php echo $selected; ?>><?php echo $_AllPartMaster->part_name . ' / ' . $_AllPartMaster->part_code; ?></option>
                                                <?php } */?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Part Cost</label>
                                            <input type="text" class="form-control" id="part_cost" name="part_cost" value="<?= $part_cost ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Material Grade</label>
                                            <select name="material_grade_id" class="custom-select select2">
                                                <?php foreach ($AllMaterialGrade as $_AllMaterialGrade) {
                                                    $selected = "";
                                                    if ($_AllMaterialGrade->id == $material_grade_id) {
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?php echo $_AllMaterialGrade->id; ?>" <?php echo $selected; ?>><?php echo $_AllMaterialGrade->material_grade_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="custom-select">
                                                <option value="Coated" <?php if ($status == 'Coated') echo 'selected'; ?>>Coated</option>
                                                <option value="Non Coated" <?php if ($status == 'Non Coated') echo 'selected'; ?>>Non Coated</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <!-- End ROW -->


                                <!-- Start ROW -->
                                <hr>
                                <div id="RmFormDivMain">
                                    <input type="hidden" id="rm_form_attribute_row_count" value="<?php if ($mode == 'Edit') {  echo count($BOMPartDetail); } else {echo '1';} ?>">
                                    <?php if ($BOMPartDetail) {
                                        $i = 0;
                                        foreach ($BOMPartDetail as $_BOMPartDetail) { ?>
                                            <div class="row" id="RmFormDivMainRow<?php echo $i; ?>">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>RM Form</label>
                                                        <select name="rm_form[]" class="custom-select">
                                                            <option value="coil" <?php if ($_BOMPartDetail->rm_form == 'coil') { echo 'selected'; } ?>>Coil</option>
                                                            <option value="strip" <?php if ($_BOMPartDetail->rm_form == 'strip') { echo 'selected'; } ?>>Strip</option>
                                                            <option value="other" <?php if ($_BOMPartDetail->rm_form == 'other') {  echo 'selected';  } ?>>Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>RM Size T</label>
                                                        <input type="text" class="form-control" id="rm_size_t" name="rm_size_t[]" placeholder="T/W/L" value="<?php echo $_BOMPartDetail->rm_size_t; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>RM Size W</label>
                                                        <input type="text" class="form-control" id="rm_size_w" name="rm_size_w[]" placeholder="T/W/L" value="<?php echo $_BOMPartDetail->rm_size_w; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label>RM Size L</label>
                                                        <input type="text" class="form-control" id="rm_size_l" name="rm_size_l[]" placeholder="T/W/L" value="<?php echo $_BOMPartDetail->rm_size_l; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>(Part/Stripe)or Coil</label>
                                                        <input type="text" class="form-control" id="part_stripe_coil_name" name="part_stripe_coil_name[]" value="<?php echo $_BOMPartDetail->part_stripe_coil_name; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Part Gross Weight</label>
                                                        <input type="text" class="form-control" id="part_gross_weight" name="part_gross_weight[]" value="<?php echo $_BOMPartDetail->part_gross_weight; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>R.M Rate</label>
                                                        <input type="text" class="form-control" id="rm_rate" name="rm_rate[]" value="<?php echo $_BOMPartDetail->rm_rate; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>R.M Cost</label>
                                                        <input type="text" class="form-control" id="rm_cost" name="rm_cost[]" value="<?php echo $_BOMPartDetail->rm_cost; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Scarp Weight</label>
                                                        <input type="text" class="form-control" id="scarp_weight" name="scarp_weight[]" value="<?php echo $_BOMPartDetail->scarp_weight; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Scrap Rate</label>
                                                        <input type="text" class="form-control" id="scarp_rate" name="scarp_rate[]" value="<?php echo $_BOMPartDetail->scarp_rate; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Scrap Cost</label>
                                                        <input type="text" class="form-control" id="scarp_cost" name="scarp_cost[]" value="<?php echo $_BOMPartDetail->scarp_cost; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>B.O.P / Part</label>
                                                        <select name="scarp_part_id[]" class="custom-select select2">
                                                            <?php foreach ($AllPart as $_AllPart) {
                                                                $selected = "";
                                                                if ($_AllPart->id == $_BOMPartDetail->scarp_part_id) {
                                                                    $selected = "selected";
                                                                }
                                                            ?>
                                                                <option value="<?php echo $_AllPart->id; ?>" <?php echo $selected; ?>><?php echo $_AllPart->inward_material_name . ' / ' . $_AllPart->BOP_code; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--<div class="col-md-3"></div>-->
                                                <?php if ($i == 0) { ?>
                                                    <div class="col-md-1">
                                                        <label>&nbsp;</label><br>
                                                        <span class="btn btn-primary btn-sm" onclick="AddRmFormDiv();"><span class="fa fa-plus"></span></span>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-md-1">
                                                        <label>&nbsp;</label><br>
                                                        <span class="btn btn-danger btn-sm" onclick="RemoveAddRmFormDiv(<?php echo $i; ?>);"><span class="fa fa-minus"></span></span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <!-- End ROW -->
                                        <?php $i++;
                                        }
                                    } else { ?>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>RM Form</label>
                                                    <select name="rm_form[]" class="custom-select">
                                                        <option value="coil">Coil</option>
                                                        <option value="strip">Strip</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>RM Size T</label>
                                                    <input type="text" class="form-control" id="rm_size_t" name="rm_size_t[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>RM Size W</label>
                                                    <input type="text" class="form-control" id="rm_size_w" name="rm_size_w[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>RM Size L</label>
                                                    <input type="text" class="form-control" id="rm_size_l" name="rm_size_l[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>(Part/Stripe)or Coil</label>
                                                    <input type="text" class="form-control" id="part_stripe_coil_name" name="part_stripe_coil_name[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Part Gross Weight</label>
                                                    <input type="text" class="form-control" id="part_gross_weight" name="part_gross_weight[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>R.M Rate</label>
                                                    <input type="text" class="form-control" id="rm_rate" name="rm_rate[]" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End ROW -->
                                        <!-- Start ROW -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>R.M Cost</label>
                                                    <input type="text" class="form-control" id="rm_cost" name="rm_cost[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Scarp Weight</label>
                                                    <input type="text" class="form-control" id="scarp_weight" name="scarp_weight[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Scrap Rate</label>
                                                    <input type="text" class="form-control" id="scarp_rate" name="scarp_rate[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Scrap Cost</label>
                                                    <input type="text" class="form-control" id="scarp_cost" name="scarp_cost[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>B.O.P / Part</label>
                                                    <select name="scarp_part_id[]" class="custom-select select2">
                                                        <?php foreach ($AllPart as $_AllPart) {
                                                            $selected = "";
                                                            if ($_AllPart->id == $scarp_part_id) {
                                                                $selected = "selected";
                                                            }
                                                        ?>
                                                            <option value="<?php echo $_AllPart->id; ?>" <?php echo $selected; ?>><?php echo $_AllPart->inward_material_name . ' / ' . $_AllPart->BOP_code; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--<div class="col-md-3"></div>-->
                                            <div class="col-md-1">
                                                <label>&nbsp;</label><br>
                                                <span class="btn btn-primary btn-sm" onclick="AddRmFormDiv();"><span class="fa fa-plus"></span></span>
                                            </div>
                                        </div>
                                        <!-- End ROW -->
                                        <hr>
                                    <?php } ?>
                                </div>
                                <!-- Start ROW -->
                                <div class="row" style="text-align: center;">
                                    <div class="col-md-12">
                                        <label>Operation</label>
                                    </div>
                                </div>
                                <hr>
                                <div id="ProductConfigDivMain">
                                    <input type="hidden" id="attribute_row_count" value="1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Operation Name</label>
                                                <select name="operation_id[]" class="custom-select select2">
                                                    <option value="">---Select---</option>
                                                    <?php foreach ($AllOperation as $_AllOperation) {
                                                        $selected = "";
                                                        if ($_AllOperation->id == $operation_id) {
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
                                                <label>Machine</label>
                                                <select name="machine_id[]" class="custom-select select2">
                                                    <option value="">---Select---</option>
                                                    <?php foreach ($AllMachine as $_AllMachine) {
                                                        $selected = "";
                                                        if ($_AllMachine->id == $machine_id) {
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
                                                <input type="text" class="form-control" id="spm_name" name="spm_name[]" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label>&nbsp;</label><br>
                                            <span class="btn btn-primary btn-sm" onclick="AddOperationDiv();"><span class="fa fa-plus"></span></span>
                                        </div>
                                    </div>
                                    <div id="sub_operation_div0">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Inspection Para.</label>
                                                    <input type="text" class="form-control" id="inspection_para" name="inspection_para[0][]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Specification</label>
                                                    <input type="text" class="form-control" id="specification" name="specification[0][]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Inspection Method</label>
                                                    <input type="text" class="form-control" id="inspection_method" name="inspection_method[0][]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Operation cost</label>
                                                    <input type="text" class="form-control" id="operation_cost" name="operation_cost[0][]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <label>&nbsp;</label><br>
                                                <span class="btn btn-primary btn-sm" onclick="AddOperationSubDiv(0);"><span class="fa fa-plus"></span></span>
                                            </div>
                                        </div>
                                        <!-- End ROW -->
                                    </div>
                                </div>


                                <!-- End : BOM Details -->
                                <div class="box-footer">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <?php if ($mode == "Edit") { ?>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>BOM Operation Details</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Operation Name / Code</th>
                                                    <th>Machine Name / Code</th>
                                                    <th>SPM Name</th>
                                                    <th>Inspection Para</th>
                                                    <th>Specification</th>
                                                    <th>Inspection Method</th>
                                                    <th>Operation Cost</th>
                                                    
                                                    <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                                </tr>
                                            </thead>
                                            <?php foreach ($BOMOperationDetailNew as $_BOMOperationDetail) { ?>
                                                <tr>
                                                    <td><?php echo $_BOMOperationDetail->operation_name . ' / ' . $_BOMOperationDetail->operation_code; ?></td>
                                                    <td><?php echo $_BOMOperationDetail->machine_name . ' / ' . $_BOMOperationDetail->machine_code; ?></td>
                                                    <td><?php echo $_BOMOperationDetail->spm_name; ?></td>
                                                    <td><?php $br = ''; foreach($_BOMOperationDetail->BOMOperationInspection as $value) {
                                                            echo $br.$value->inspection_para;
                                                            $br = '<hr style="margin: 0;">';
                                                        }?>
                                                    </td>
                                                    <td><?php $br = ''; foreach($_BOMOperationDetail->BOMOperationInspection as $value) {
                                                            echo $br.$value->specification;
                                                            $br = '<hr style="margin: 0;">';
                                                        }?>
                                                    </td>
                                                    <td><?php $br = ''; foreach($_BOMOperationDetail->BOMOperationInspection as $value) {
                                                            echo $br.$value->inspection_method;
                                                            $br = '<hr style="margin: 0;">';
                                                        }?>
                                                    </td>
                                                    <td><?php $br = ''; foreach($_BOMOperationDetail->BOMOperationInspection as $value) {
                                                            echo $br.$value->operation_cost;
                                                            $br = '<hr style="margin: 0;">';
                                                        }?>
                                                    </td>
                                                    <td class="no-sort center-text-table">
                                                        <button class="btn btn-primary btn-xs" onclick="EditOperationDetail(<?php echo $_BOMOperationDetail->id; ?>);"><i class="fas fa-edit"></i></button>
                                                        <a href="<?php echo base_url() . 'admin/BOM/operationBOMdelete/' . $_BOMOperationDetail->id.'/'.$id; ?>" onclick="return confirm('Are you sure?');">
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

<div id="OperationDetailDivPopup"></div>
<style>
    .error {
        color: red;
    }
</style>
<script>
    function AddOperationDiv() {

        var tmp = 1;
        var count = $('#attribute_row_count').val();
        $('#attribute_row_count').val(parseInt(count) + parseInt(tmp));
        var html = '<hr><div class="ProductConfigRow' + count + '">';
        html += '<div class="row">';
        html += '<div class="col-md-4"> ';
        html += '<div class="form-group">';
        html += '<label> Operation Name </label>';
        html += '<select name="operation_id[]" class="custom-select select2">';
        html += '<option value="">---Select---</option>';
        <?php foreach ($AllOperation as $_AllOperation) { ?> 
            html += '<option value="<?php echo $_AllOperation->id; ?>" <?php echo $selected; ?>><?php echo $_AllOperation->operation_name; ?></option>';
        <?php } ?>
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4"> ';
        html += '<div class="form-group">';
        html += '<label>Machine</label>';
        html += '<select name="machine_id[]" class="custom-select select2">';
        html += '<option value="">---Select---</option>';
        <?php foreach ($AllMachine as $_AllMachine) { ?> 
            html += '<option value="<?php echo $_AllMachine->id; ?>" <?php echo $selected; ?>><?php echo $_AllMachine->machine_name; ?></option>';
        <?php } ?>
        html += '</select>';
        html += '</div>';
        html += '</div> ';
        html += '<div class="col-md-3"> ';
        html += '<div class="form-group">';
        html += '<label>SPM</label>';
        html += '<input type="text" class="form-control" id="spm_name" name="spm_name[]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-1"> ';
        html += '<span class="btn btn-danger btn-sm" onclick="RemoveProductConfigDiv(' + count + ');"><span class="fa fa-minus"></span></span>';
        html += '</div>';
        html += '</div>';

        html += '<div id="sub_operation_div' + count + '">';
        html += '<div class="row">';
        html += '<div class="col-md-2"> ';
        html += '<div class="form-group">';
        html += '<label>Inspection Para</label>';
        html += '<input type="text" class="form-control" id="inspection_para" name="inspection_para[' + count + '][]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2"> ';
        html += '<div class="form-group">';
        html += '<label>Specification</label>';
        html += '<input type="text" class="form-control" id="specification" name="specification[' + count + '][]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2"> ';
        html += '<div class="form-group">';
        html += '<label>Inspection Method</label>';
        html += '<input type="text" class="form-control" id="inspection_method" name="inspection_method[' + count + '][]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2"> ';
        html += '<div class="form-group">';
        html += '<label>Operation cost</label>';
        html += '<input type="text" class="form-control" id="operation_cost" name="operation_cost[' + count + '][]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-1"> ';
        html += '<span class="btn btn-primary btn-sm" onclick="AddOperationSubDiv(' + count + ');"><span class="fa fa-plus"></span></span>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        $("#ProductConfigDivMain").append(html);
          $('.select2').select2();
    }

    function RemoveProductConfigDiv(attribute_row_count) {
        $('.ProductConfigRow' + attribute_row_count).remove();
    }

    function AddOperationSubDiv(count) {
        var tmp = 1;
        var numItems = $('.ProductConfigSubRow').length
        var html = '';
        html += '<div class="row ProductConfigSubRow" id="ProductConfigSubRow' + numItems + '">';
        html += '<div class="col-md-2"> ';
        html += '<div class="form-group">';
        html += '<input type="text" class="form-control" id="inspection_para" name="inspection_para[' + count + '][]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2"> ';
        html += '<div class="form-group">';
        html += '<input type="text" class="form-control" id="specification" name="specification[' + count + '][]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2"> ';
        html += '<div class="form-group">';
        html += '<input type="text" class="form-control" id="inspection_method" name="inspection_method[' + count + '][]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2"> ';
        html += '<div class="form-group">';
        html += '<input type="text" class="form-control" id="operation_cost" name="operation_cost[' + count + '][]" value="">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-1"> ';
        html += '<span class="btn btn-danger btn-sm" onclick="RemoveOperationSubDiv(' + numItems + ');"><span class="fa fa-minus"></span></span>';
        html += '</div>';
        html += '</div>';
        $('#sub_operation_div' + count).append(html);
    }

    function RemoveOperationSubDiv(attribute_row_count) {
        $('#ProductConfigSubRow' + attribute_row_count).remove();
    }

    function AddRmFormDiv() {

        var tmp = 1;
        var count = $('#rm_form_attribute_row_count').val();
        $('#rm_form_attribute_row_count').val(parseInt(count) + parseInt(tmp));

        var html = '<div class="row" id="RmFormDivMainRow' + count + '">';
        html += '<div class="col-md-2">';
            html += '<div class="form-group">';
                html += '<label>RM Form</label>';
                html += '<select name="rm_form[]" class="custom-select">';
                html += '<option value="coil">Coil</option>';
                html += '<option value="strip">Strip</option>';
                html += '<option value="other">Other</option>';
                html += '</select>';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-1">';
            html += '<div class="form-group">';
                html += '<label>RM Size T</label>';
                html += '<input type="text" class="form-control" id="rm_size_t" name="rm_size_t[]" value="">';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-1">';
            html += '<div class="form-group">';
                html += '<label>RM Size W</label>';
                html += '<input type="text" class="form-control" id="rm_size_w" name="rm_size_w[]" value="">';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-1">';
            html += '<div class="form-group">';
                html += '<label>RM Size L</label>';
                html += '<input type="text" class="form-control" id="rm_size_l" name="rm_size_l[]" value="">';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2">';
            html += '<div class="form-group">';
                html += '<label>(Part/Stripe)or Coil</label>';
                html += '<input type="text" class="form-control" id="part_stripe_coil_name" name="part_stripe_coil_name[]" value="">';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2">';
            html += '<div class="form-group">';
                html += '<label>Part Gross Weight</label>';
                html += '<input type="text" class="form-control" id="part_gross_weight" name="part_gross_weight[]" value="">';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2">';
            html += '<div class="form-group">';
                html += '<label>R.M Rate</label>';
                html += '<input type="text" class="form-control" id="rm_rate" name="rm_rate[]" value="">';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2">';
            html += '<div class="form-group">';
                html += '<label>R.M Cost</label>';
                html += '<input type="text" class="form-control" id="rm_cost" name="rm_cost[]" value="">';
            html += '</div>';
        html += '</div>';

        html += '<div class="col-md-2">';
            html += '<div class="form-group">';
                html += '<label>Scarp Weight</label>';
                html += '<input type="text" class="form-control" id="scarp_weight" name="scarp_weight[]" value="">';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2">';
            html += '<div class="form-group">';
                html += '<label>Scrap Rate</label>';
                html += '<input type="text" class="form-control" id="scarp_rate" name="scarp_rate[]" value="">';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2">';
            html += '<div class="form-group">';
                html += '<label>Scrap Cost</label>';
                html += '<input type="text" class="form-control" id="scarp_cost" name="scarp_cost[]" value="">';
            html += '</div>';
        html += '</div>';
        html += '<div class="col-md-3">';
        html += '<div class="form-group">';
        html += '<label>B.O.P / Part</label>';
        html += '<select name="scarp_part_id[]" class="custom-select select2">';
        <?php foreach ($AllPart as $_AllPart) {
            // $selected = "";
            // if ($_AllPart->id == $scarp_part_id) {
            //     $selected = "selected";
            // }
        ?>
            html += '<option value="<?php echo $_AllPart->id; ?>"><?php echo $_AllPart->inward_material_name . ' / ' . $_AllPart->BOP_code; ?></option>';
        <?php } ?>
        html += '</select>';
        html += '</div>';
        html += '</div>';
        //        html += '<div class="col-md-3"></div>';
        html += '<div class="col-md-1"> <br>';
        html += '<span class="btn btn-danger btn-sm" onclick="RemoveAddRmFormDiv(' + count + ');"><span class="fa fa-minus"></span></span>';
        html += '</div>';
        html += '</div>';
        $("#RmFormDivMain").append(html);
    }

    function RemoveAddRmFormDiv(attribute_row_count) {
        console.log('attribute_row_count---', attribute_row_count)
        $('#RmFormDivMainRow' + attribute_row_count).remove();
    }
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $(function() {

            // Setup form validation on the #register-form element
            $("#departmentUser-master").validate({
                // Specify the validation rules
                rules: {
                    part_cost: "required",
                    qc_inspector: "required",
                    total_inspected_qty: {
                        required: true,
                        number: true,
                    },
                    rejected_qty: {
                        required: true,
                        number: true,
                    },
                    rework_qty: {
                        required: true,
                        number: true,
                    },
                    problem_statement: "required",
                    remark: "required",
                    final_ok_qty: {
                        required: true,
                        number: true,
                    },
                    job_card_number: "required"
                },

                // Specify the validation error messages
                messages: {
                    part_cost: "Please enter part cost",
                    qc_inspector: "Please enter a qc inspector",
                    total_inspected_qty: {
                        required: "Please enter total inspected quantity",
                        number: "Enter only number",
                    },
                    rejected_qty: {
                        required: "Please enter rejected quantity",
                        number: "Enter only number",
                    },
                    rework_qty: {
                        required: "Please enter rework quantity",
                        number: "Enter only number",
                    },
                    problem_statement: "Please enter problem statement",
                    remark: "Please enter remark",
                    final_ok_qty: {
                        required: "Please enter final ok quantity",
                        number: "Enter only number",
                    },
                    job_card_number: "Please enter job card number"
                }

            });

        });
    });

    function EditOperationDetail(operation_id) {
        $.ajax({
            url: "<?php echo base_url() . "admin/BOM/edit_operation_detail"; ?>",
            method: "POST",
            data: {
                operation_id: operation_id
            },
            success: function(data) {
                $('#OperationDetailDivPopup').html(data);
                $('#OperationDetailDivModal').modal('show');
            }
        });
    }
    
    GetCustomerPartAndCode();
    
    function GetCustomerPartAndCode() {
        var customer_id = $("#customer_id").val();
        var part_id = '<?php echo $part_id;?>';
        $.ajax({
            url: "<?php echo base_url() . "admin/BOM/get_customer_part_and_code"; ?>",
            method: "POST",
            data: {
                customer_id: customer_id,part_id:part_id
            },
            success: function(data) {
                $('#part_id').html(data); 
            }
        });
    }
    
    
    
</script>