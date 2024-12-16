
<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Student Walllet History </h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Student">Student</a></li>
                        <li class="breadcrumb-item active">Student Walllet History</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button style="float: right;" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Wallet</button>
                        <table id="DataTableComman" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                   <th>Wallet Amount</th>
                                   <th>Transaction Number</th> 
                                   <th>Transaction Type</th>
                                   <th>Status</th>
                                   <th>Created</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($AllStudentWallet as $_AllStudentWallet) {
                                   
                                    ?>
                                    <tr> 
                                        <td><?php echo $_AllStudentWallet->wallet_amount; ?></td>
                                        <td><?php echo $_AllStudentWallet->transaction_number; ?></td>
                                        <td><?php echo $_AllStudentWallet->transaction_type; ?></td>
                                        <td><?php echo $_AllStudentWallet->status; ?></td>
                                        <td><?php echo date("d-m-Y h:i A", strtotime($_AllStudentWallet->created)); ?></td>
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
<!-- content -->

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="position: absolute;float: right;right: 11px;top: 3px;font-size: 30px;">&times;</button>
          <h4 class="modal-title" style="    text-align: center;width: 100%;">Add Student Wallet</h4>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
             <form id="departmentUser-master" method="post" action="<?php echo base_url(); ?>admin/Student/addStudentWallet" enctype="multipart/form-data" novalidate="novalidate">
            <div class="col-md-12">
                <label>Wallet Amount</label>
                <input type="hidden" name="student_id" value="<?php echo $student_id?>">
                <input type="Number" name="wallet_amont" class="form-control">
                 <button style="float: left;margin-top: 10px;" class="btn btn-primary">Add Wallet</button>
            </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>