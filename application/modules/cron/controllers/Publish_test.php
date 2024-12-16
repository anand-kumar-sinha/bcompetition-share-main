<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author https://www.roytuts.com
 */
class Publish_test extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
//        $adminData = $this->session->userdata('adminData');
//        if(!isset($adminData)){
//             redirect('admin/Login');
//        }	
    }
    
    function publish_now() {
        
        $CreatedTestData['tableName'] = "test";
        $CreatedTestData['condtion'] = "status='Created' AND is_deleted=0 AND CURDATE()";
        $AllCreatedTest = $this->SystemModel->getAll($CreatedTestData);
        echo '<pre>';
        print_r($AllCreatedTest);
        echo '</pre>';
        exit;
    }
}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */