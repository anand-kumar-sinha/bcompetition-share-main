<?php
if (isset($DispatchData)) {
    $id = $DispatchData->id;
    $challan_number = $DispatchData->challan_number;
    $ship_to = $DispatchData->ship_to;
    $vehicle_number = $DispatchData->vehicle_number;
    $dispatch_date = date("m/d/Y", strtotime($DispatchData->dispatch_date));
    $DispatchDetail = $DispatchData->DispatchDetail;
    $mode          = 'Edit';
} else {
    $id = '';
    $challan_number = '';
    $ship_to = '';
    $vehicle_number = '';
    $dispatch_date = '';
    $DispatchDetail = '';
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/dispatch">Dispatch List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Dispatch</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Dispatch</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>department_user/dispatch/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control date" id="dispatch_date" name="dispatch_date" value="<?= $dispatch_date ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Ship To</label>
                                            <input type="text" class="form-control" id="ship_to" name="ship_to" value="<?= $ship_to ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Vehicle Number</label>
                                            <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" value="<?= $vehicle_number ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- End ROW -->

                                <div id="dispatch_default_div">
                                    <input type="hidden" id="rm_form_attribute_row_count" value="1">
                                    <!-- Start ROW -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <select name="customer_id[]" class="custom-select select2">
                                                    <?php foreach ($AllCustomer as $_AllCustomer) { ?>
                                                        <option value="<?php echo $_AllCustomer->id; ?>"><?php echo $_AllCustomer->customer_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>P.O No / Part Name</label>
                                                <select name="po_part_id[]" class="custom-select">
                                                    <?php foreach ($AllPart as $_AllPart) { ?>
                                                        <option value="<?php echo $_AllPart->id; ?>"><?php echo $_AllPart->part_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Part Number</label>
                                                <select name="part_id[]" class="custom-select">
                                                    <?php foreach ($AllPart as $_AllPart) { ?>
                                                        <option value="<?php echo $_AllPart->id; ?>"><?php echo $_AllPart->part_code; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label>&nbsp;</label><br>
                                            <span class="btn btn-primary btn-sm" onclick="AddDispatchDiv();"><span class="fa fa-plus"></span></span>
                                        </div>
                                    </div>
                                    <!-- End ROW -->
                                    <!-- Start ROW -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>QTY</label>
                                                <input type="text" class="form-control" id="qty" name="qty[]" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <input type="text" class="form-control" id="unit" name="unit[]" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Authorizes Person</label>
                                                <input type="text" class="form-control" id="authorizes_person" name="authorizes_person[]" value="">
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
                                                        <option value="<?php echo $_AllJobCardList->id; ?>"> <?php echo $_AllJobCardList->job_card_number; ?> </option>;
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Batch No</label>
                                                <input type="text" class="form-control" id="batch_no" name="batch_no[]" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status[]" class="custom-select">
                                                    <option value="Active">Active</option>
                                                    <option value="Deactive">Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <?php if ($mode == "Edit") { ?>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Dispatch sub Details</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Part Name / Code</th>
                                                    <th>Qty</th>
                                                    <th>Status</th>
                                                    <th class="no-sort center-text-table" style="width: 10%;">Action</th>
                                                </tr>
                                            </thead>
                                            <?php foreach ($DispatchDetail as $_DispatchDetail) {

                                                if ($_DispatchDetail->status == "Active") {
                                                    $btnClass = "btn-success";
                                                } else {
                                                    $btnClass = "btn-danger";
                                                } ?>
                                                <tr>
                                                    <td><?php echo $_DispatchDetail->customer_name; ?></td>
                                                    <td><?php echo $_DispatchDetail->part_name . ' / ' . $_DispatchDetail->part_code; ?></td>
                                                    <td><?php echo $_DispatchDetail->qty; ?></td>
                                                    <td>
                                                        <button class="btn btn-block btn-xs <?php echo $btnClass; ?>"><?php echo $_DispatchDetail->status; ?></button>
                                                    </td>
                                                    <td class="no-sort center-text-table">
                                                        <button class="btn btn-primary btn-xs" onclick="EditDispatchSubDetail(<?php echo $_DispatchDetail->id; ?>);"><i class="fas fa-edit"></i></button>
                                                        <a href="<?php echo base_url() . 'department_user/dispatch/dispatchSubdelete/' . $_DispatchDetail->id . '/' . $id; ?>" onclick="return confirm('Are you sure?');">
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
    function AddDispatchDiv() {
        console.log('call function')
        var tmp = 1;
        var count = $('#rm_form_attribute_row_count').val();
        $('#rm_form_attribute_row_count').val(parseInt(count) + parseInt(tmp));

        var html = '<div class="row Row_' + count + '">';
        html += '<div class="col-md-3"> ';
        html += '<div class="form-group">';
        html += '<label>Customer Name</label>';
        html += '<select name="customer_id[]" class="custom-select select2">';
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
        html += '<span class="btn btn-danger btn-sm" onclick="RemoveDispatchDiv(' + count + ');"><span class="fa fa-minus"></span></span>';
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

        $("#dispatch_default_div").append(html);
        $('.select2').select2();
    }

    function RemoveDispatchDiv(count) {
        $('.Row_' + count).remove();
    }
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

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
        $(function() {

            // Setup form validation on the #register-form element
            $("#departmentUser-master").validate({
                // Specify the validation rules
                rules: {
                    vehicle_number: "required",
                    ship_to: "required",
                },

                // Specify the validation error messages
                messages: {
                    vehicle_number: "Please enter vehicle number",
                    ship_to: "Please enter a ship to",
                }

            });

        });
    });

    function EditDispatchSubDetail(dispatch_detail_id) {
        $.ajax({
            url: "<?php echo base_url() . "department_user/dispatch/edit_sub_dispatch_detail"; ?>",
            method: "POST",
            data: {
                dispatch_detail_id: dispatch_detail_id
            },
            success: function(data) {
                $('#OperationDetailDivPopup').html(data);
                $('#OperationDetailDivModal').modal('show');
            }
        });
    }
</script>