<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile_setting extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SystemModel');

	$adminData = $this->session->userdata('adminData');
        if (!isset($adminData)) 
	{
            redirect('admin/Login');
        }
    }

    public function index()
    {
        $data['getlogin_master'] = $this->SystemModel->getlogin_master();
        $this->load->admin('store/profile_setting', $data);
    }
//e10adc3949ba59abbe56e057f20f883e
    public function changeProfile()
    {
        $postArr = $this->input->post();
        if(!empty($postArr['password'])){
            $updatedata = [
                'name' => $postArr['name'],
                'username' => $postArr['username'],
                'email' => $postArr['email'],
                'password' => md5($postArr['password']),
            ];
        }else{
            $updatedata = [
                'name' => $postArr['name'],
                'username' => $postArr['username'],
                'email' => $postArr['email'],
            ];
        }
        $this->SystemModel->updateProfule($updatedata);
        redirect('admin/Profile_setting');
        
    }

}