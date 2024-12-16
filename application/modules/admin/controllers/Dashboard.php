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
        $adminData = $this->session->userdata('adminData');
        if(!isset($adminData)){
             redirect('admin/Login');
        }	
    }
    
    function index() {
        $data = array();
        
        $adminData = $this->session->userdata('adminData');
       
        $studentData['tableName'] = 'student';
        $studentData['condtion'] = "is_deleted=0";
        $data['AllStudent'] = $this->SystemModel->getAll($studentData);
        
        $categoryData['tableName'] = 'category'; 
        $categoryData['condtion'] = "is_deleted=0";
        $data['AllCategory'] = $this->SystemModel->getAll($categoryData);
        
        $CreatedTestData['tableName'] = "test";
        $CreatedTestData['condtion'] = "status='Created' AND  is_deleted=0";
        $data['AllCreatedTest'] = $this->SystemModel->getAll($CreatedTestData);
        
        $modelData['select'] = 'stm.*,st.name,st.wallet_amount, cou.country_name, sta.state_name, cit.city_name';
        $modelData['tableName'] = 'student_transfer_money stm';
        $modelData['join'][] = array('tableName' => 'student st', 'condtion' => 'st.id=stm.student_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'country cou', 'condtion' => 'cou.id=st.country_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'state sta', 'condtion' => 'sta.id=st.state_id', 'type'=>'left');
        $modelData['join'][] = array('tableName' => 'city cit', 'condtion' => 'cit.id=st.city_id', 'type'=>'left');
        $modelData['condtion'] = "stm.status='Pending'";
        $data['AllStudentTransfer'] = $this->SystemModel->getAll($modelData);
        
        $this->load->admin('dashboard/index',$data);
    }

}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */