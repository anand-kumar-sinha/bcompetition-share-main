<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Refer_earn_level extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SystemModel');


        $adminData = $this->session->userdata('adminData');
        if (!isset($adminData)) {
            redirect('admin/Login');
        }
    }

    public function index()
    {
         
        $data['earn_data'] = $this->SystemModel->refer_earn_level_price();
        $this->load->admin('refer_earn_level/index', $data);
    }


    public function action($value='')
    {
        $postArr = $this->input->post();
        $updateData = [
            'member_level1' => $postArr['member_level1'],
            'member_level2' => $postArr['member_level2'],
            'member_level3' => $postArr['member_level3'],
            'member_level4' => $postArr['member_level4'],
            'member_level5' => $postArr['member_level5'],
            'course_level1' => $postArr['course_level1'],
            'course_level2' => $postArr['course_level2'],
            'course_level3' => $postArr['course_level3'],
            'course_level4' => $postArr['course_level4'],
            'course_level5' => $postArr['course_level5'],
            'test_active_level1' => $postArr['test_active_level1'],
            'test_active_level2' => $postArr['test_active_level2'],
            'test_active_level3' => $postArr['test_active_level3'],
            'test_active_level4' => $postArr['test_active_level4'],
            'test_active_level5' => $postArr['test_active_level5'],
            'test_submit_level1' => $postArr['test_submit_level1'],
            'test_submit_level2' => $postArr['test_submit_level2'],
            'test_submit_level3' => $postArr['test_submit_level3'],
            'test_submit_level4' => $postArr['test_submit_level4'],
            'test_submit_level5' => $postArr['test_submit_level5'],
            'package_level1' => $postArr['package_level1'],
            'package_level2' => $postArr['package_level2'],
            'package_level3' => $postArr['package_level3'],
            'package_level4' => $postArr['package_level4'],
            'package_level5' => $postArr['package_level5'],
            'adpackageactive1' => $postArr['adpackageactive1'],
            'adpackageactive2' => $postArr['adpackageactive2'],
            'adpackageactive3' => $postArr['adpackageactive3'],
            'adpackageactive4' => $postArr['adpackageactive4'],
            'adpackageactive5' => $postArr['adpackageactive5'],
        ];
        
         $result = $this->SystemModel->update_refer($updateData);
         $successMessage = "Record added successfully";
          $this->session->set_flashdata('success', $successMessage);
          redirect('admin/Refer_earn_level');
    }
}
