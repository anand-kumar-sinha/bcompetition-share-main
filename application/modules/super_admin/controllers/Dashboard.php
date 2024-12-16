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
        $superAdminData = $this->session->userdata('superAdminData');
        if(!isset($superAdminData)){
             redirect('super_admin/Login');
        }	
    }
    
    function index() {
        extract($this->input->post()); // convert array to variable -- php function //
        $data = array();
         
        $modelData['tableName'] = 'branch';
        $modelData['condtion'] = "is_deleted=0";
        $data['AllBranch'] = $this->SystemModel->getAll($modelData);
        
        $this->load->super_admin('dashboard/index', $data);
    }

}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */