<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author https://www.roytuts.com
 */
class Home_page extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');
//        $adminData = $this->session->userdata('adminData');
//        if(!isset($adminData)){
//             redirect('admin/Login');
//        }	
    }
    
    function index() {
        $this->load->front('home_page/index');
    }

    function about_us() {
        $this->load->front('home_page/about_us');
    }
    
    function committee() {
        $this->load->front('home_page/committee');
    }
    
    function supporters_vpag() {
        $this->load->front('home_page/supporters_vpag');
    }
    
    function all_india_foto_video_fair() {
        $this->load->front('home_page/all_india_foto_video_fair');
    }
    
    function twinty_fifteen_aiff_highlights() {
        $this->load->front('home_page/twinty_fifteen_aiff_highlights');
    }
    
    
    function guests_vpag() {
        $this->load->front('home_page/guests_vpag');
    }
    
    function shree_narendramodi_felicitating_vpag() {
        $this->load->front('home_page/shree_narendramodi_felicitating_vpag');
    }
    
    function past_events() {
        $this->load->front('home_page/past_events');
    }
    
    function contact() {
        
        $this->load->front('home_page/contact');
    }
    
    
    
}

/* End of file Site.php */
/* Location: ./application/modules/site/controllers/site.php */