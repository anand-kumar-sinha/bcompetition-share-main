<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SystemModel');      
    }
    public function main_question_list() {

        
        extract($this->input->post()); // convert array to variable -- php function //
            
            $partyData['tableName'] = "faq_main_question";  
            $partyData['order'][0] = "id";
            $partyData['order'][1] = "DESC";
            $AllMainQuestion = $this->SystemModel->getAll($partyData); 
            

            if(count($AllMainQuestion) > 0){
    //            $this->add_companyId_session($company_id); //Add company id in session
//                    $MainQuestionDetail = $this->SystemModel->getOne($modelData);
                    
                    $TempArray = array();
                    $i=0;
                    foreach ($AllMainQuestion as $_AllMainQuestion) {
                        $TempArray[$i] = (array)$_AllMainQuestion;
                        $modelData1['tableName'] = "faq_sub_question";        
                        $modelData1['condtion'] = "main_question_id=" . $_AllMainQuestion->id;
                        $SubQuestionList = $this->SystemModel->getAll($modelData1);
                        $TempArray[$i]['sub_question_list'] = $SubQuestionList;
                        $i++;
                    }
                    
                    
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Question List',
                        'data'   => $TempArray,
                    );

            } else {
                 $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Question Available',
                    'data'      => null
                );
            }
        
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    public function sub_question_list() {
        extract($this->input->post()); // convert array to variable -- php function //
       
//        if(isset($auth_id) && isset($party_id) && isset($currency_id) && isset($currency) && isset($total_amount) && isset($transaction_type) && isset($party_type)){
            
            $modelData['tableName'] = "faq_main_question";        
            $modelData['condtion'] = "id=" . $main_question_id;
            $UserCount = $this->SystemModel->tableRowCount($modelData);
            
             if ($UserCount > 0) { 
                $PartyDetail = $this->SystemModel->getOne($modelData);
                
                $modelData1['tableName'] = "faq_sub_question";        
                $modelData1['condtion'] = "main_question_id=" . $main_question_id;
                $SubQuestionList = $this->SystemModel->getAll($modelData1);
                
                if($SubQuestionList > 0) {
                    $jsonArray = array(
                        'status'    => 1,
                        'message'   => 'Sub Question',
                        'data'      => $SubQuestionList
                    );
                } else {
                    $jsonArray = array(
                        'status'    => 0,
                        'message'   => 'No Sub Question',
                        'data'      => array()
                    );
                }
             } else {
                 $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No Party Available', 
                    'data'      => array()
                );
             }
//        }  else {
//            $jsonArray = array(
//                    'status'    => 0,
//                   'message'   => 'Please fill all required field',
//                   'data'      => Null
//            );
//        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
    public function sub_question_like_dislike() {
        extract($this->input->post()); // convert array to variable -- php function //
       
        if(isset($auth_id) && isset($auth_token) && isset($sub_question_id) && isset($like_dislike)){
            
            $modelData1['tableName'] = "faq_sub_question";        
            $modelData1['condtion'] = "id=" . $sub_question_id;
            $SubQuestionCount = $this->SystemModel->tableRowCount($modelData1);
            
             if ($SubQuestionCount > 0) { 
                $SubQuestionDetail = $this->SystemModel->getOne($modelData1);
                  
                $userModelData['tableName'] = "user_faq_like_dislike";        
                $userModelData['condtion'] = "sub_question_id=" . $sub_question_id." AND user_id=".$auth_id;
                $UserFaqCount = $this->SystemModel->tableRowCount($userModelData);
                if($UserFaqCount > 0){
                    if($like_dislike == 0){
                        $userModelData['data'] = array(     
                                                     'is_dislike'    => 1,
                                                     'is_like'    => 0,
                                                     'updated'  => date('Y-m-d h:i:s')
                        );
                        $userModelData['condtion'] = "sub_question_id=" . $sub_question_id." AND user_id=".$auth_id;
                        $result = $this->SystemModel->updateData($userModelData);
                        
                        
                        $OldDislikeCount = $SubQuestionDetail->dislike_count;
                        $NewDislikeCount = $OldDislikeCount + 1;
                        
                        $OldlikeCount = $SubQuestionDetail->like_count;
                        $NewlikeCount = $OldlikeCount - 1;
                        
                        $modelData1['data'] = array(     
                                                     'dislike_count'    => $NewDislikeCount,
                                                     'like_count'    => $NewlikeCount,
                                                     'updated'  => date('Y-m-d h:i:s')
                        );
                        $modelData1['condtion'] = "id=" . $sub_question_id;
                        $result = $this->SystemModel->updateData($modelData1);
                        
                    } else {
                        $userModelData['data'] = array(     
                                                     'is_dislike'    => 0,
                                                     'is_like'    => 1,
                                                     'updated'  => date('Y-m-d h:i:s')
                        );
                        $userModelData['condtion'] = "sub_question_id=" . $sub_question_id." AND user_id=".$auth_id;
                       $result = $this->SystemModel->updateData($userModelData);
                       
                         
                        $OldlikeCount = $SubQuestionDetail->like_count;
                        $NewlikeCount = $OldlikeCount + 1;
                        
                        $OldDislikeCount = $SubQuestionDetail->dislike_count;
                        $NewDislikeCount = $OldDislikeCount - 1;
                        
                        $modelData1['data'] = array(     
                                                    'like_count'    => $NewlikeCount,
                                                    'dislike_count'    => $NewDislikeCount,
                                                    'updated'  => date('Y-m-d h:i:s')
                        );
                        $modelData1['condtion'] = "id=" . $sub_question_id;
                        $result = $this->SystemModel->updateData($modelData1);
                    }
                   
                    
                } else {
                    if($like_dislike == 0){
                        $userModelData['data'] = array(     
                                                     'sub_question_id'    => $sub_question_id,
                                                     'user_id'    => $auth_id,
                                                     'is_dislike'    => 1,
                                                     'is_like'    => 0,
                                                     'created'  => date('Y-m-d h:i:s')
                        );
                        $result = $this->SystemModel->insertData($userModelData);
                        
                        
                        $OldDislikeCount = $SubQuestionDetail->dislike_count;
                        $NewDislikeCount = $OldDislikeCount + 1;
                        
                        $OldlikeCount = $SubQuestionDetail->like_count;
                        $NewlikeCount = $OldlikeCount - 1;
                        
                        $modelData1['data'] = array(     
                                                     'dislike_count'    => $NewDislikeCount,
                                                     'like_count'    => $NewlikeCount,
                                                     'updated'  => date('Y-m-d h:i:s')
                        );
                        $modelData1['condtion'] = "id=" . $sub_question_id;
                        $result = $this->SystemModel->updateData($modelData1);
                        
                    } else {
                        $userModelData['data'] = array(     
                                                     'sub_question_id'    => $sub_question_id,
                                                     'user_id'    => $auth_id,
                                                     'is_dislike'    => 0,
                                                     'is_like'    => 1,
                                                     'created'  => date('Y-m-d h:i:s')
                        );
                        $result = $this->SystemModel->insertData($userModelData);
                       
                         
                        $OldlikeCount = $SubQuestionDetail->like_count;
                        $NewlikeCount = $OldlikeCount + 1;
                        
                        $OldDislikeCount = $SubQuestionDetail->dislike_count;
                        $NewDislikeCount = $OldDislikeCount - 1;
                        
                        $modelData1['data'] = array(     
                                                    'like_count'    => $NewlikeCount,
                                                    'dislike_count'    => $NewDislikeCount,
                                                    'updated'  => date('Y-m-d h:i:s')
                        );
                        $modelData1['condtion'] = "id=" . $sub_question_id;
                        $result = $this->SystemModel->updateData($modelData1);
                    }
                }
                 
                
                $jsonArray = array(
                    'status'    => 1,
                    'message'   => 'Review Sucessfully submited',
                    'data'      => array()
                );
             } else {
                 $jsonArray = array(
                    'status'    => 0,
                    'message'   => 'No question Available', 
                    'data'      => array()
                );
             }
        }  else {
            $jsonArray = array(
                    'status'    => 0,
                   'message'   => 'Please fill all required field',
                   'data'      => Null
            );
        }
        $jsonString = json_encode($jsonArray);
        echo $jsonString;
        die;
    }
    
   
    
}

