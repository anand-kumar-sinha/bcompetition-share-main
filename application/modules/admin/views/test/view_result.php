<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-10">
                    <h4 class="page-title">Publish Test Result</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Test">Test List</a></li>
                        <li class="breadcrumb-item active">Result</li>
                    </ol>

                </div>
                <div class="col-sm-2"> 
                    <input type="hidden" id="apply_test_id" value="<?php echo $apply_test_id;?>">
                    <button class="btn btn-success btn-sm" onclick="PublishResult();" style="background-color: #2182CF; border-color: #2182CF;">Publish Result</button>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                   <th>Test Name</th>
                                   <th>Test Type</th>
                                   <th>Student Name</th>
                                   <th>Test Attempt Date</th>
                                   <th>Total Mark</th>
                                   <th>Get Mark</th>
                                   <th>Take Time</th>
                                   <th>Rank</th>
                                   <th>Won Amount</th>
                                   <th>#</th>
                                   </tr>
                            </thead>
                            <tbody>
                                 <?php foreach ($student_detail as $_student_detail) { ?>
                                    <tr>
                                        <td><?php echo $test_detail->test_title;?></td>
                                        <td><?php echo $test_detail->test_type;?></td>
                                        <td><?php echo $_student_detail['student_name'];?></td>
                                        <td><?php echo date("d-m-Y", strtotime($_student_detail['created']));?></td>
                                        <td><?php echo $_student_detail['total_mark'];?></td>
                                        <td><?php echo $_student_detail['get_mark'];?></td>
                                        <td><?php echo $_student_detail['total_time'];?></td>
                                        <td><?php echo $_student_detail['rank'];?></td>
                                        <td><?php echo $_student_detail['cash_prize'];?></td>
                                        <td>
                                            <?php echo $_student_detail['total_correnct_ans'];?> : <b>Correnct</b> &nbsp;&nbsp;&nbsp;
                                            <?php echo $_student_detail['total_wrong_ans'];?> : <b>Wrong</b>&nbsp;&nbsp;&nbsp;<br>
                                            <?php echo $_student_detail['total_skipped_ans'];?> : <b>Skipped</b>&nbsp;&nbsp;&nbsp;
                                            <?php echo $_student_detail['total_mark_for_review'];?> : <b>Mark For Review</b>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container-fluid -->

</div>

 
<script>
    
function PublishResult() {
     var apply_test_id = $("#apply_test_id").val();
    if(confirm("Are you sure you want to Publish Result?")){
        $.ajax({
            url: "<?php echo base_url() . "admin/Test/publish_result_action"; ?>",
            method: "POST",
            data: {
                apply_test_id: apply_test_id,   
            },
            success: function(data) { 
                window.history.back();
            }
        });
    } else {
        return false;
    } 
}
</script>