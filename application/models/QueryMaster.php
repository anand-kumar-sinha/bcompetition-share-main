<?php

class QueryMaster extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');		
        
    }
    
    
    public function getAllClassDiv() {        
        
        $classDivData['select'] = 'dm.*,cm.class_name';
        $classDivData['tableName'] = 'division_master dm';
        $classDivData['join'][] = array('tableName' => 'class_master cm', 'condtion' => 'dm.class_id=cm.id');
        $data['AllClassDivData'] = $this->SystemModel->getAll($classDivData);
        return $data['AllClassDivData'];
    }

    public function getAllSubjects($div_id) {
        $classDivData['tableName'] = 'div   ision_master';
        $data['AllTeacher'] = $this->SystemModel->getAll($classDivData);
        return $data['AllTeacher'];
    }
    
    
}
?>