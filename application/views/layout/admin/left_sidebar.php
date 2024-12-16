<?php  

    $adminData = $this->session->userdata('adminData'); 
    function word_check($word) {

        $string = $_SERVER['REQUEST_URI'];

        if (strpos($string, $word) !== false) {
            return TRUE;
        }else{
            return FALSE;
        }

    }
      
 
?>
<style>
.waves-effect.active {
    color: #b4c9de !important;
}
</style>
  <!-- Main Sidebar Container -->
   <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>
                            <li>
                                <a href="<?php echo base_url();?>admin/Dashboard" class="waves-effect <?php if (word_check('Dashboard')){echo "active";}?>">
                                    <i class="ti-home"></i><span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>admin/Company_detail/company_detail_edit/1" class="waves-effect <?php if (word_check('Company_detail')){echo "active";}?>">
                                    <i class="ti-home"></i><span> Company Detail </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>admin/Banner_master" class="waves-effect <?php if (word_check('Banner_master')){echo "active";}?>">
                                    <i class='fas fa-image'></i><span> Banner </span>
                                </a>
                            </li>
                             <li>
                                <a href="<?php echo base_url();?>admin/Refer_earn_level" class="waves-effect <?php if (word_check('Refer_earn_level')){echo "active";}?>">
                                    <i class='fas fa-image'></i><span> Refer Earn </span>
                                </a>
                            </li>
                             <li>
                                <a href="<?php echo base_url();?>admin/Manage_package_info" class="waves-effect <?php if (word_check('Manage_package_info')){echo "active";}?>">
                                    <i class='fas fa-image'></i><span> Package Info </span>
                                </a>
                            </li>
                             <li>
                                <a href="<?php echo base_url();?>admin/Manage_autopool_package" class="waves-effect <?php if (word_check('Manage_autopool_package')){echo "active";}?>">
                                    <i class='fas fa-store'></i><span> Autopool Package </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>admin/Category" class="waves-effect <?php if (word_check('Category')){echo "active";}?>">
                                    <i class='fas fa-university'></i><span> Category </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>admin/Store" class="waves-effect <?php if (word_check('Store')){echo "active";}?>">
                                    <i class='fas fa-store'></i><span> Store </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect" aria-expanded="<?php if (word_check('Country') || word_check('State') || word_check('City')){echo "true";}?>"><i class='fas fa-building'></i><span> Locality <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu <?php if (word_check('Country') || word_check('State') || word_check('City')){echo "mm-show";}?>">
                                    <li>
                                        <a href="<?php echo base_url();?>admin/Country" class="waves-effect <?php if (word_check('Country')){echo "active";}?>">
                                            <i class='fas fa-building'></i><span> Country </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>admin/State" class="waves-effect <?php if (word_check('State')){echo "active";}?>">
                                            <i class='fas fa-building'></i><span> State </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>admin/City" class="waves-effect <?php if (word_check('City')){echo "active";}?>">
                                            <i class='fas fa-building'></i><span> City </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect" aria-expanded="<?php if (word_check('Student') || word_check('transfer_request_index')){echo "true";}?>"><i class='fas fa-users'></i><span> Student <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu <?php if (word_check('Student') || word_check('transfer_request_index')){echo "mm-show";}?>">
                                    <li>
                                        <a href="<?php echo base_url();?>admin/Student" class="waves-effect <?php if (word_check('Student')){echo "active";}?>">
                                            <i class='fas fa-users'></i><span> Manage Student </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>admin/Student/transfer_request_index" class="waves-effect <?php if (word_check('transfer_request_index')){echo "active";}?>">
                                            <i class='fas fa-building'></i><span> Transfer Request </span>
                                        </a>
                                    </li>
                                     <li>
                                        <a href="<?php echo base_url();?>admin/Student/transfer_history_request_index" class="waves-effect <?php if (word_check('transfer_request_index')){echo "active";}?>">
                                            <i class='fas fa-building'></i><span> Transfer History </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                             <li>
                                <a href="javascript:void(0);" class="waves-effect" aria-expanded="<?php if (word_check('Test') || word_check('test_subscription_index')){echo "true";}?>"><i class='fas fa-users'></i><span> Test <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu <?php if (word_check('Test') || word_check('test_subscription_index')){echo "mm-show";}?>">
                                    <li>
                                        <a href="<?php echo base_url();?>admin/Test" class="waves-effect <?php if (word_check('Test')){echo "active";}?>">
                                            <i class='fas fa-users'></i><span> Manage Test </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>admin/Test/test_subscription_index" class="waves-effect <?php if (word_check('test_subscription_index')){echo "active";}?>">
                                            <i class='fas fa-building'></i><span> Test Subscription </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                             <li>
                                <a href="<?php echo base_url();?>admin/Profile_setting" class="waves-effect <?php if (word_check('Profile_setting')){echo "active";}?>">
                                    <i class='fas fa-image'></i><span> Profile Setting </span>
                                </a>
                            </li>
                              <!-- <li>
                                <a href="<?php echo base_url();?>admin/Student/student_refer_level" class="waves-effect <?php if (word_check('student_refer_level')){echo "active";}?>">
                                    <i class='fas fa-image'></i><span> Group Level </span>
                                </a>
                            </li> -->
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
             <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">