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
        
            $modelData['tableName'] = "login_master";
            $modelData['condtion']  = "username='" . $username . "' AND password = '" . md5($password) . "'";
            $result = $this->SystemModel->tableRowCount($modelData);
          
            if ($result > 0) {
                 
                $result = $this->SystemModel->getOne($modelData); 
                $this->session->set_userdata('superAdminData', $result);
                
                $superAdminData = $this->session->userdata('superAdminData'); 
                redirect('super_admin/Dashboard');
            } else {
                $this->session->set_flashdata('error', 'Type or Username or Password did not match');
                redirect('super_admin/Login');
            }
          
        die;
    }
    public function logout()
    {   
        $this->session->unset_userdata('superAdminData');
        $this->session->set_flashdata('success', 'Successfully logout');
        redirect('super_admin/Login');
    }
}
?> 