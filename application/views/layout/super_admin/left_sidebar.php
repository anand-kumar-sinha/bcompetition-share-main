<?php  

    $superAdminData = $this->session->userdata('superAdminData'); 
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
                                <a href="<?php echo base_url();?>super_admin/Dashboard" class="waves-effect <?php if (word_check('Dashboard')){echo "active";}?>">
                                    <i class="ti-home"></i><span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>super_admin/Branch" class="waves-effect <?php if (word_check('Branch')){echo "active";}?>">
                                    <i class='fas fa-university'></i><span> Branch </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect" aria-expanded="<?php if (word_check('Country') || word_check('State') || word_check('City')){echo "true";}?>"><i class='fas fa-building'></i><span> Locality <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu <?php if (word_check('Country') || word_check('State') || word_check('City')){echo "mm-show";}?>">
                                    <li>
                                        <a href="<?php echo base_url();?>super_admin/Country" class="waves-effect <?php if (word_check('Country')){echo "active";}?>">
                                            <i class='fas fa-building'></i><span> Country </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>super_admin/State" class="waves-effect <?php if (word_check('State')){echo "active";}?>">
                                            <i class='fas fa-building'></i><span> State </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>super_admin/City" class="waves-effect <?php if (word_check('City')){echo "active";}?>">
                                            <i class='fas fa-building'></i><span> City </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>super_admin/Level" class="waves-effect <?php if (word_check('Level')){echo "active";}?>">
                                    <i class='fas fa-info'></i><span> Level </span>
                                </a>
                            </li>
<!--                            <li class="nav-item has-treeview <?php if (word_check('BOM')){echo "menu-open";}?>">
                                <a href="#" class="nav-link <?php if (word_check('BOM')){echo "menu-open";}?>">
                                  <i class="nav-icon fas fa-copy"></i>
                                  <p>
                                    BOM
                                    <i class="fas fa-angle-left right"></i>
                                  </p>
                                </a>
                                <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="<?php echo base_url();?>admin/BOM" class="nav-link <?php if (word_check('BOM')){echo "active";}?>">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>BOM</p>
                                    </a>
                                  </li>
                                </ul>
                            </li>-->
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