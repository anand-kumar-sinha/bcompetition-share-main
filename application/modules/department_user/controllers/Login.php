 <?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SystemModel');
    }
    public function index()
    {
        $data = array();
     
        $this->load->view('login/index');
        
        
    }
    public function action()
    {
        extract($this->input->post()); // convert array to variable -- php function //            
        
            $modelData['tableName'] = "department_user";
            $modelData['condtion']  = "contact_number='" . $username . "' AND password = '" . md5($password) . "'";
            $result = $this->SystemModel->tableRowCount($modelData);
            
            if ($result > 0) {
                
                $result = $this->SystemModel->getOne($modelData); 
               
                if($result->status != 'Active' || $result->is_deleted != '0'){
                    $this->session->set_flashdata('error', 'Your account is now deactived. Please contact to admin.');
                    redirect('department_user/Login');
                }
                $this->session->set_userdata('departmentUserData', $result);
                
                $departmentUserData = $this->session->userdata('departmentUserData'); 
                 
                redirect('department_user/Dashboard');
            } else {
                $this->session->set_flashdata('error', 'Type or Username or Password did not match');
                redirect('department_user/Login');
            }
          
        die;
    }
    public function logout()
    {   
        $this->session->unset_userdata('departmentUserData');
        $this->session->set_flashdata('success', 'Successfully logout');
        redirect('department_user/Login');
    }
}
?> 