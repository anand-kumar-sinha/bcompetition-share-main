<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH . "third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
    
    public function admin($template_name, $vars = array(), $return = FALSE) {
        if ($this->session->userdata('adminData')){
            $content = $this->view('layout/admin/header', $vars, $return);
            $content .= $this->view('layout/admin/left_sidebar', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('layout/admin/footer', $vars, $return);
            return $content;
          } else {
            $this->session->set_flashdata('error','Please login once to access any page');
            redirect('admin/login');
        }
    }
    
    public function super_admin($template_name, $vars = array(), $return = FALSE) {
        if ($this->session->userdata('superAdminData')){
            $content = $this->view('layout/super_admin/header', $vars, $return);
            $content .= $this->view('layout/super_admin/left_sidebar', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('layout/super_admin/footer', $vars, $return);
            return $content;
          } else {
            $this->session->set_flashdata('error','Please login once to access any page');
            redirect('super_admin/login');
        }
    }
    public function department_user($template_name, $vars = array(), $return = FALSE) {
        if ($this->session->userdata('departmentUserData')){
            $content = $this->view('layout/department_user/header', $vars, $return);
            $content .= $this->view('layout/department_user/left_sidebar', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('layout/department_user/footer', $vars, $return);
            return $content;
          } else {
            $this->session->set_flashdata('error','Please login once to access any page');
            redirect('department_user/login');
        }
    }
    public function front($template_name, $vars = array(), $return = FALSE) {
//         if ($this->session->userdata('teacherData')){
            $content = $this->view('layout/front/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('layout/front/footer', $vars, $return);
            return $content;
//         } else {
//            $this->session->set_flashdata('error','Please login once to access any page');
//            redirect('teachers/login');
//        }
    }
    
}
