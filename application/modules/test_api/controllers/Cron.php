<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author https://www.roytuts.com
 */
class Cron extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
//        $adminData = $this->session->userdata('adminData');
//        if(!isset($adminData)){
//             redirect('admin/Login');
//        }	
    }
    
    function publish_test_now() {
        
        $PublishOnGoingTestData['select'] = 'te.*,te.id as testId, ap.*,ap.id as appy_cate_id, cat.category_name';
        $PublishOnGoingTestData['tableName'] = "test te"; 
        $PublishOnGoingTestData['join'][] = array('tableName' => 'apply_test ap', 'condtion' => 'ap.test_id=te.id', 'type'=>'left');
        $PublishOnGoingTestData['join'][] = array('tableName' => 'category cat', 'condtion' => 'cat.id=ap.category_id', 'type'=>'left');
//        $PublishOnGoingTestData['condtion'] = "ap.publish_at='".$Today."' AND ap.status !='Un-Published'";
        $PublishOnGoingTestData['condtion'] = "ap.publish_at = CURDATE()";
        $AllPublishOnGoingTest  = $this->SystemModel->getAll($PublishOnGoingTestData); 
        
        
        foreach ($AllPublishOnGoingTest as $_AllPublishOnGoingTest){ 
            $status = "Published & On-Going";

            $ApplyTestCatData['tableName'] = "apply_test";
            $ApplyTestCatData['data'] = array(
                'status' => $status,
                'updated' => date('Y-m-d H:i:s')
            );
            $ApplyTestCatData['condtion'] = "id=" . $_AllPublishOnGoingTest->id;
            $result = $this->SystemModel->updateData($ApplyTestCatData);
        }
         
    }
}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */