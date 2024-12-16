<?php 
$adminData = $this->session->userdata('adminData');
 
?>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url();?>assets/admin/dist/js/pages/dashboard.js"></script>

 <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                
                                <div class="col-sm-6">
                                    <h4 class="page-title">Dashboard</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Welcome to Testbook Dashboard</li>
                                    </ol>

                                </div>
                                <div class="col-sm-6">
                                
<!--                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle arrow-none waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-settings mr-2"></i> Settings
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                    </div>-->

                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-warning text-white">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class='fas fa-university' style='font-size:55px'></i>
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white">Category</h5> <!-- -50-->
                                            <h4 class="font-500"><?php echo count($AllCategory);?></h4>
<!--                                            <div class="mini-stat-label bg-success">
                                                <p class="mb-0">+ 12%</p>
                                            </div>-->
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="<?php echo base_url();?>admin/Category" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
                                            <p class="text-white mb-0">More Info</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class='fas fa-users' style='font-size:55px'></i>
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white">Student</h5> <!-- -50-->
                                            <h4 class="font-500"><?php echo count($AllStudent);?></h4>
<!--                                            <div class="mini-stat-label bg-success">
                                                <p class="mb-0">+ 12%</p>
                                            </div>-->
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="<?php echo base_url();?>admin/student" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
                                            <p class="text-white mb-0">More Info</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-info text-white">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class='fas fa-copy' style='font-size:55px'></i>
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white">Test</h5> <!-- -50-->
                                            <h4 class="font-500"><?php echo count($AllCreatedTest);?></h4>
<!--                                            <div class="mini-stat-label bg-success">
                                                <p class="mb-0">+ 12%</p>
                                            </div>-->
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="<?php echo base_url();?>admin/Test" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
                                            <p class="text-white mb-0">More Info</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-secondary text-white">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class='fas fa-copy' style='font-size:55px'></i>
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white">Transfer Request</h5> <!-- -50-->
                                            <h4 class="font-500"><?php echo count($AllStudentTransfer);?></h4>
<!--                                            <div class="mini-stat-label bg-success">
                                                <p class="mb-0">+ 12%</p>
                                            </div>-->
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="<?php echo base_url();?>admin/Student/transfer_request_index" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
                                            <p class="text-white mb-0">More Info</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- content -->

<style>
.bg-light {
  background-color: #ca2481 !important;
}
.bg-purple {
  background-color: #b25cde !important;
}
.bg-parrot {
  background-color: #a4cf21 !important;
}
.bg-blue {
  background-color: #21cfbf !important;
}
</style>