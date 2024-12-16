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
     
    $companyData['tableName'] = 'company_master';   
    $companyData['condtion'] = 'id='.$adminData->company_id;        
    $AllCompany = $this->SystemModel->getOne($companyData); 
 
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #000;">
    <!-- Brand Logo -->
    <a href="#" target="_blank" class="brand-link" style="text-align: center; ">
        <!--<img src="<?php //echo base_url();?>assets/images/logo.jpg" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8; max-height: 40px;">-->
        <span class="brand-text font-weight-light"><?php echo $AllCompany->company_name;?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?>assets/images/user1.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $adminData->person_name; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="<?php echo base_url();?>admin/Dashboard" class="nav-link <?php if (word_check('Dashboard')){echo "active";}?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
          <li class="nav-item has-treeview <?php if (word_check('Department_master') || word_check('Department_user') || word_check('Customer_master') || word_check('Supplier_master') || word_check('Part_master') || word_check('Machine_master') || word_check('Operation_master') || word_check('Material_grade_master') || word_check('Inward_BOP_material_master')){echo "menu-open";}?>">
            <a href="#" class="nav-link <?php if (word_check('Department_master') || word_check('Department_user') || word_check('Customer_master') || word_check('Supplier_master') || word_check('Part_master') || word_check('Machine_master') || word_check('Operation_master') || word_check('Material_grade_master') || word_check('Inward_BOP_material_master') ){echo "active";}?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <li class="nav-item">
                <a href="<?php echo base_url();?>admin/Department_master" class="nav-link <?php if (word_check('Department_master')){echo "active";}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Department Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/Department_user" class="nav-link <?php if (word_check('Department_user')){echo "active";}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Department User</p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/Customer_master" class="nav-link <?php if (word_check('Customer_master')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Customer Master</p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/Supplier_master" class="nav-link <?php if (word_check('Supplier_master')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Supplier Master</p>
                  </a>
                </li>
               <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/Part_master" class="nav-link <?php if (word_check('Part_master')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Part Master</p>
                  </a>
                </li>
               <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/Machine_master" class="nav-link <?php if (word_check('Machine_master')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Machine Master</p>
                  </a>
                </li>
               <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/Operation_master" class="nav-link <?php if (word_check('Operation_master')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Operation Master</p>
                  </a>
                </li>
               <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/Material_grade_master" class="nav-link <?php if (word_check('Material_grade_master')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Material Grade Master</p>
                  </a>
                </li>
               <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/Inward_BOP_material_master" class="nav-link <?php if (word_check('Inward_BOP_material_master')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inward BOP Material Master</p>
                  </a>
                </li>
            </ul>
          </li>
          
         <li class="nav-item has-treeview <?php if (word_check('BOM')){echo "menu-open";}?>">
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
          </li>
           <li class="nav-item has-treeview <?php if (word_check('Inward')){echo "menu-open";}?>">
              <a href="#" class="nav-link <?php if (word_check('Inward')){echo "menu-open";}?>">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Inward
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/Inward" class="nav-link <?php if (word_check('Inward')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inward</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview <?php if (word_check('job_card')){echo "menu-open";}?>">
              <a href="#" class="nav-link <?php if (word_check('job_card')){echo "menu-open";}?>">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Job Card
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/job_card" class="nav-link <?php if (word_check('job_card')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Job Card</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview <?php if (word_check('Quality')){echo "menu-open";}?>">
              <a href="#" class="nav-link <?php if (word_check('Quality')){echo "menu-open";}?>">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Quality
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/Quality" class="nav-link <?php if (word_check('Quality')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Quality</p>
                  </a>
                </li>
              </ul>
            </li> 
            <li class="nav-item has-treeview <?php if (word_check('dispatch')){echo "menu-open";}?>">
              <a href="#" class="nav-link <?php if (word_check('dispatch')){echo "menu-open";}?>">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Dispatch
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/dispatch" class="nav-link <?php if (word_check('dispatch')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dispatch</p>
                  </a>
                </li>
              </ul>
            </li>
          
           <li class="nav-item has-treeview <?php if (word_check('schedule')){echo "menu-open";}?>">
              <a href="#" class="nav-link <?php if (word_check('schedule')){echo "menu-open";}?>">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Schedule
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>admin/schedule" class="nav-link <?php if (word_check('schedule')){echo "active";}?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Schedule</p>
                  </a>
                </li>
              </ul>
            </li>
          
            <li class="nav-item has-treeview <?php if (word_check('Labour_work')){echo "menu-open";}?>">
                <a href="#" class="nav-link  <?php if (word_check('Labour_work')){echo "active";}?>">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Labour Work
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo base_url();?>admin/Labour_work" class="nav-link <?php if (word_check('Labour_work')){echo "active";}?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Labour Work</p>
                    </a>
                  </li>
                </ul>
            </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>