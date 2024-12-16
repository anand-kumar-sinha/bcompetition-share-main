<?php
if (isset($JobCardDetail)) {
    $id = $JobCardDetail->id;
    $job_card_date = date("m/d/Y", strtotime($JobCardDetail->job_card_date));
    $bom_detail_id = $JobCardDetail->bom_detail_id;
    $customer_id = $JobCardDetail->customer_id;
    $inward_batch_no_id = $JobCardDetail->inward_batch_no_id;
    $status = $JobCardDetail->status;
    $mode          = 'Edit';
} else {
    $id = '';
    $job_card_date = '';
    $bom_detail_id = '';
    $customer_id = '';
    $inward_batch_no_id = '';
    $status = '';
    $mode      = 'Add';
}
// echo '<pre>JobCardDetail--';
// print_r($JobCardDetail); die;
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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>department_user/job_card">Job Card List</a></li>
                        <li class="breadcrumb-item active"><?php echo $mode; ?> Job Card</li>
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
                                <h3 class="card-title"><?php echo $mode; ?> Job Card</h3>
                            </div>
                        </div>
                        <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>department_user/job_card/action" enctype="multipart/form-data" novalidate="novalidate">
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Start ROW -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control date" id="job_card_date" name="job_card_date" value="<?= $job_card_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Customer Name (Contact)</label>
                                            <select name="customer_id" class="custom-select">
                                                <?php foreach ($AllCustomer as $_AllCustomer) { ?>
                                                    <option value="<?php echo $_AllCustomer->id; ?>" <?php if ($_AllCustomer->id == $customer_id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?php echo $_AllCustomer->customer_name . ' (' . $_AllCustomer->contact . ')'; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Part Name/PartCode/BOM</label>
                                            <select name="bom_detail_id" class="custom-select" onchange="getBomPartOperation(this.value)">
                                                <option value="">--Select--</option>
                                                <?php foreach ($AllBom as $_AllBom) { ?>
                                                    <option value="<?php echo $_AllBom->bom_detail_id; ?>" <?php if ($_AllBom->bom_detail_id == $bom_detail_id) {echo 'selected';} ?>><?php echo $_AllBom->bom_number . '/' . $_AllBom->part_name . '/' . $_AllBom->part_code . '/' . $_AllBom->rm_form . '/' . $_AllBom->rm_size; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Batch No</label>
                                            <select name="inward_batch_no_id" class="custom-select" id="batch_no">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="custom-select">
                                                <option value="Active" <?php if ($status == 'Active') {
                                                                            echo 'selected';
                                                                        } ?>>Active</option>
                                                <option value="InActive" <?php if ($status == 'InActive') {
                                                                                echo 'selected';
                                                                            } ?>>InActive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="job_bom_operation_div"></div>
                                <div class="box-footer">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
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

<style>
    .error {
        color: red;
    }
</style>
<script>
    $(document).ready(function() {
        var mode = "<?= $mode ?>";
        var bom_id = "<?= $bom_detail_id ?>"
        
        if (mode == 'Edit' && bom_id != '') {
            var inward_batch_no_id = '<?= $inward_batch_no_id ?>'
            console.log('inward_batch_no_id-----',inward_batch_no_id)
            getBomPartOperation(bom_id)
            getBatchNo(bom_id, inward_batch_no_id)
        }

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
                    inward_batch_no_id: "required",
                },

                // Specify the validation error messages
                messages: {
                    inward_batch_no_id: "Please enter batch no",
                }

            });

        });
    });

    function getBomPartOperation(bom_detail_id) {

        getBatchNo(bom_detail_id)
        var id = $('#id').val();
        $.ajax({
            url: "<?php echo base_url() . "department_user/job_card/getBomPartOperation"; ?>",
            method: "POST",
            data: {
                bom_detail_id: bom_detail_id,
                job_card_id: id
            },
            success: function(data) {
                $('#job_bom_operation_div').html(data);
            }
        });
    }

    function getBatchNo(bom_detail_id, inward_batch_no_id = '') {
        var id = $('#id').val();
        if(inward_batch_no_id == ''){
            inward_batch_no_id  = 0
        }
        $.ajax({
            url: "<?php echo base_url() . "department_user/job_card/getInwardBatchNo"; ?>",
            method: "POST",
            data: {
                bom_detail_id: bom_detail_id,
                inward_batch_no_id: inward_batch_no_id
            },
            dataType: 'html',
            success: function(data) {
                // console.log(data)
                $('#batch_no').html(data);
            }
        });
    }
</script>