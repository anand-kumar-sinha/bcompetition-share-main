<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author https://www.roytuts.com
 */
class Dashboard extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
        $departmentUserData = $this->session->userdata('departmentUserData');
      
      
        if(!isset($departmentUserData) || $departmentUserData==''){
             
             redirect('department_user/Login');
        }	
        
    }
    
    function index() {

        $modelData['tableName'] = 'department_master';
        $data['AllDepartment'] = $this->SystemModel->tableRowCount($modelData);  
        
        $modelDUserData['tableName'] = 'department_user';
        $data['AllDepartmentUser'] = $this->SystemModel->tableRowCount($modelDUserData);
        
        $this->load->department_user('dashboard/index',$data);
    }

}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */