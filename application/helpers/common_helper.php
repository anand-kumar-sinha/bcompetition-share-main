<?php 
function getStudent($id){ 
	$CI = & get_instance();
	$CI->db->where('id', $id);
    $apps = $CI->db->get('student');
	return $apps->row();
}