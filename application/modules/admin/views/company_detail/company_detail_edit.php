<?php
if (isset($Company_detailDetail)) {
    $id = $Company_detailDetail->id;
    $about_us = $Company_detailDetail->about_us;
    $mobile_number = $Company_detailDetail->mobile_number;
    $email = $Company_detailDetail->email;
    $address = $Company_detailDetail->address;
    $refer_amount = $Company_detailDetail->refer_amount;
    $facebook_url = $Company_detailDetail->facebook_url;
    $youtube_url = $Company_detailDetail->youtube_url;
    $whatsapp_url = $Company_detailDetail->whatsapp_url;
    $insta_url = $Company_detailDetail->insta_url;
    $twitter_url = $Company_detailDetail->twitter_url;
    $telegram_url = $Company_detailDetail->telegram_url;
    $mode          = 'Edit';
} else {
    $id = '';
    $about_us = '';
    $mobile_number = '';
    $email = '';
    $address = '';
    $refer_amount = '';
    $facebook_url = '';
    $youtube_url = '';
    $whatsapp_url = '';
    $insta_url = '';
    $mode      = 'Add';
}
?>

<!-- Start content -->
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h4 class="page-title">Company Detail</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Company Detail</li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form id="Company_detail_Form" method="post" action="<?php echo base_url(); ?>admin/Company_detail/action" enctype="multipart/form-data" novalidate="novalidate">
                                <!-- Start : BOM Details -->
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">About Us<span class="error">*</span></label>
                                        <input id="about_us" name="about_us" type="text" value="<?php echo $about_us;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Mobile Number<span class="error">*</span></label>
                                        <input id="mobile_number" name="mobile_number" type="text" value="<?php echo $mobile_number;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">E-mail<span class="error">*</span></label>
                                        <input id="email" name="email" type="email" value="<?php echo $email;?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Address<span class="error">*</span></label>
                                        <input id="address" name="address" type="text" value="<?php echo $address;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Refer Amount<span class="error">*</span></label>
                                        <input id="refer_amount" name="refer_amount" type="text" value="<?php echo $refer_amount;?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Facebook Url</label>
                                        <input id="facebook_url" name="facebook_url" type="text" value="<?php echo $facebook_url;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Youtube Url</label>
                                        <input id="youtube_url" name="youtube_url" type="text" value="<?php echo $youtube_url;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Whatsapp Url</label>
                                        <input id="whatsapp_url" name="whatsapp_url" type="text" value="<?php echo $whatsapp_url;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Instagram Url</label>
                                        <input id="insta_url" name="insta_url" type="text" value="<?php echo $insta_url;?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Twitter Url</label>
                                        <input id="twitter_url" name="twitter_url" type="text" value="<?php echo $twitter_url;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="txtFirstNameBilling">Telegram Url</label>
                                        <input id="telegram_url" name="telegram_url" type="text" value="<?php echo $telegram_url;?>" class="form-control">
                                    </div>
                                </div>
                                 
                            </div>
                            <div class="box-footer">
                                <a href="<?php echo base_url();?>admin/Dashboard"><button type="button" class="btn btn-secondary">Cancel</button></a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->

</div>
<!-- content -->

<script>
    function CancelData() {
        $('#Company_detail_Form').trigger("reset");
    }
    
    $(document).ready(function() {
//        $('.select2').select2();
        $(function() {

            // Setup form validation on the #register-form element
            $("#Company_detail_Form").validate({
                // Specify the validation rules
                rules: {
                    about_us: "required",
                    email: "required",
                    address: "required",
                    mobile_number: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10,
                    }, 
                    refer_amount: {
                        required: true,
                        number: true,
                    }, 
                },

                // Specify the validation error messages
                messages: {
                    about_us: "Please enter about Company",
                    email: "Please enter email",
                    address: "Please enter address",
                    mobile_number: {
                        required: "Enter Mobile No",
                        number: "Enter only number",
                        maxlength: "Please enter maximum 10 latters in Number",
                        minlength: "Please enter minimum 10 latters in Number",
                    },
                    refer_amount: {
                        required: "Enter refer amount",
                        number: "Enter only number",
                    },
                }

            });

        });
    });

    
    
</script>