<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Overseas Desire</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/admin/images/favicon.ico">

        <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assets/admin/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assets/admin/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>assets/admin/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div class="wrapper-page">

            <div class="card overflow-hidden account-card mx-3">
                
                <div class="bg-primary p-4 text-white text-center position-relative">
                    <h4 class="font-20 m-b-5">Welcome Back !</h4>
                    <p class="text-white-50 mb-4">Sign in to continue to Overseas Desire.</p>
                    <a href="index.html" class="logo logo-admin"><img src="<?php echo base_url();?>assets/admin/images/logo.png" height="24" alt="logo"></a>
                </div>
                <div class="account-card-content"> 
                    <?php if ($this->session->has_userdata('error')) { ?>      
                        <div class="alert alert-danger alert-dismissible">        
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>       
                            <strong><i class="icon fa fa-ban"></i> Error! </strong>        
                            <?php echo $this->session->flashdata('error'); ?>                      
                        </div>        
                    <?php } ?>     
                    <form method="post" class="form-horizontal m-t-30" action="<?php echo base_url() . "super_admin/login/action"; ?>">
                        
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

<!--                        <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                <a href="pages-recoverpw.html"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                            </div>
                        </div>-->
                    </form>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p>&copy; 2022 Overseas Desire <span class="d-none d-sm-inline-block"> - Developed by <a href="#" target="_blank"> Digisys India Tech</a></span></p>
            </div>

        </div>
        <!-- end wrapper-page -->


        <!-- jQuery  -->
        <script src="<?php echo base_url();?>assets/admin/js/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/js/metisMenu.min.js"></script>
        <script src="<?php echo base_url();?>assets/admin/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url();?>assets/admin/js/waves.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url();?>assets/admin/js/app.js"></script>

    </body>

</html>