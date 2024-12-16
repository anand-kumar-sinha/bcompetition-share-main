<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Banner_master extends MY_Controller
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
        
		$modelData['select'] = 'banner_master.*, category.category_name';
        $modelData['tableName'] = 'banner_master';
		$modelData['join'][] = array('tableName' => 'category', 'condtion' => 'banner_master.category_id=category.id', 'type'=>'left');
        $data['AllBanner_master'] = $this->SystemModel->getAll($modelData);
        
        if(isset($_GET['c_id'])){
            $id = $_GET['c_id'];
            $banner_masterEditData['tableName'] = 'banner_master';
            $banner_masterEditData['condtion'] = "id=" . $id;
            $data['Banner_masterDetail'] = $this->SystemModel->getOne($banner_masterEditData);
        }
        
        // 25-apr-2022
        $categoryModelData['tableName'] = 'category';
        $categoryModelData['condtion'] = "is_deleted=0";
        $data['AllCategory'] = $this->SystemModel->getAll($categoryModelData);
        
        $this->load->admin('banner_master/index', $data);
    }

    public function add_edit($id = '')
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        $data = array();
        if ($id != '') {
            $modelData['tableName'] = 'banner_master';
            $modelData['condtion'] = "id=" . $id;
            $data['BOMDetail'] = $this->SystemModel->getOne($modelData);
        }
      


        $this->load->admin('banner_master/add_edit', $data);
    }

    public function action()
    {
        //        $this->SystemModel->checkAccess('car_brand_add_edit');// role access management
        extract($this->input->post()); // convert array to variable -- php function //

        $uploadPath = FCPATH . 'uploads/banner_image';
                //Check if the directory already exists.
              if (!is_dir($uploadPath)) {
                  //Directory does not exist, so lets create it.
              mkdir($uploadPath, 0755, true);
          }
        if($category_id) {
                $category_id = $category_id;
        } else {
                $category_id = NULL;
        }

        $modelData['tableName'] = "banner_master";
        if (isset($id) && $id != '') {
            if ($_FILES['banner']['name'] != '') {
                $banner = $this->SystemModel->imageUpload('banner', $uploadPath);
                $path = FCPATH . 'uploads/banner_image';
                unlink($path);
            } else {
                $banner = $old_banner;
            }

            $modelData['data'] = array(
                'category_id' => $category_id,
                'banner' => $banner,
                'updated' => date('Y-m-d H:i:s')
            );
            $modelData['condtion'] = "id=" . $id;
            $result = $this->SystemModel->updateData($modelData);


            $successMessage = "Record updated successfully";
            $errorMessage = "No recoard updated";
        } else {

            if (isset($_FILES['banner']['name']) && $_FILES['banner']['name'] != '') {
                $banner = $this->SystemModel->imageUpload('banner', $uploadPath);
            } else {
                $banner = '';
            }

            $modelData['data'] = array(
		'category_id' => $category_id,
                'banner' => $banner,
                'created' => date('Y-m-d H:i:s')
            );
            $result = $this->SystemModel->insertData($modelData);
            $inserted_client_id = $this->SystemModel->lastInsertId();

          
            $successMessage = "Record added successfully";
            $errorMessage = "No added updated";
        }

       
        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Banner_master');
    }



    public function delete($id)
    {
        //        $this->SystemModel->checkAccess('car_brand_delete');// role access management

        /************** Delete Labour work Detail *************/

        $modelData['tableName'] = "banner_master";
        $modelData['condtion'] = "id=" . $id;
        $result = $this->SystemModel->deleteData($modelData);

        $successMessage = "Record deleted successfully";
        $errorMessage = "No record deleted";

        if ($result) {
            $this->session->set_flashdata('success', $successMessage);
        } else {
            $this->session->set_flashdata('error', $errorMessage);
        }
        redirect('admin/Banner_master');
    }

     
}
