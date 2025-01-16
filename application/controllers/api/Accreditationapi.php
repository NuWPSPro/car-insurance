<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accreditationapi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->model('Users_model','users_model');
		$this->load->model('professional_model');
		$this->load->model('accreditationapi_model','accapi');
        header('Access-Control-Allow-Origin: *');
    }

    function CepAccreditationApi(){
        header('Content-type: application/json');
        $json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true);
        // echo $this->db->last_query();
        if(empty($jsonvalue['email'])):
            $result['code']  = 404;
            $result['error'] = true;
            $result['msg']  = 'Insufficient records in parameter!';
        else:
            $email = $jsonvalue['email'];
            $user_name = $jsonvalue['user_name'];
            $userdata = $this->accapi->isUserExists($email);
            // if($userdata != '' ):
            if(1):
                $saveAcc = array(
                    // 'user_id'   => $userdata['id'],
                    // 'doc_id'    => $userdata['id'],
                    'user_email'=> $email,
                    'user_id'   => 0,
                    'doc_id'    => 0,
                    'doc_name'  => $user_name,
                    'type'      => 'cep',
                    'acc_number'=> $jsonvalue['accreditation_num'],
                    'validity'  => $jsonvalue['accreditation_validity'],
                    'website_of_rb'=> $jsonvalue['website'],
                    'status'    => '1'
                );
                $success = $this->accapi->saveCepAccreditation($saveAcc);
                $result['code']  = 200;
                $result['error'] = false;
                $result['msg']  = 'Cep accreditation successfully sent.';
                $result['data']  = $success;
            else:
                $result['code']  = 404;
                $result['error'] = true;
                $result['msg']  = 'No data found!';
            endif;
        endif;
        
        echo json_encode($result);
    } 

    function onlineCourseaccApi(){
        header('Content-type: application/json');
		$json_file	= file_get_contents('php://input');
		$jsonvalue	= json_decode($json_file,true); 
        // echo $jsonvalue['email']; die;
        if($jsonvalue!=""):
            $email = $jsonvalue['email'];
            $course_name = $jsonvalue['course_name'];
            $userdata = $this->accapi->isUserExists($email);
            $coursedata = $this->accapi->isCourseExists($userdata['id'],$course_name);
            if($userdata != '' && $coursedata != ''):
                $saveAcc = array(
                    'user_email'=> $email,
                    'user_id'   => $userdata['id'],
                    'doc_id'    => $coursedata['id'],
                    'doc_name'    => $course_name,
                    'type'      => 'oc',
                    'acc_number'=> $jsonvalue['accreditation_num'],
                    'validity'  => $jsonvalue['accreditation_validity'],
                    'website_of_rb'=> $jsonvalue['website'],
                    'status'    => '1'
                );
                $success = $this->accapi->saveCepAccreditation($saveAcc);
                // echo $this->db->last_query();die;
                $result['code']  = 200;
                $result['error'] = false;
                $result['msg']  = 'Online course accreditation successfully sent.';
                $result['data']  = $success;
            else:
                $result['code']  = 404;
                $result['error'] = true;
                $result['msg']  = 'No data found!';
            endif;
            
        else:
            $result['code']  = 404;
            $result['error'] = true;
            $result['msg']  = 'Insufficient records in parameter!';
        endif;
        
        echo json_encode($result);
    } 

    function trainingCourseaccApi(){
        header('Content-type: application/json');
        $json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true);
        // echo $this->db->last_query();
        if(empty($jsonvalue['email'])):
            $result['code']  = 404;
            $result['error'] = true;
            $result['msg']  = 'Insufficient records in parameter!';
        else:
            $email = $jsonvalue['email'];
            $training_name = $jsonvalue['training_name'];
            $userdata = $this->accapi->isUserExists($email);
            $trainingdata = $this->accapi->isTrainingExists($userdata['id'],$training_name);
            if($userdata != '' && $trainingdata != ''):
                $saveAcc = array(
                    'user_email'=> $email,
                    'user_id'   => $userdata['id'],
                    'doc_id'    => $trainingdata['id'],
                    'doc_name'    => $training_name,
                    'type'      => 'tc',
                    'acc_number'=> $jsonvalue['accreditation_num'],
                    'validity'  => $jsonvalue['accreditation_validity'],
                    'website_of_rb'=> $jsonvalue['website'],
                    'status'    => '1'
                );
                $success = $this->accapi->saveCepAccreditation($saveAcc);
                $result['code']  = 200;
                $result['error'] = false;
                $result['msg']  = 'Training course accreditation successfully sent.';
                $result['data']  = $success;
            else:
                $result['code']  = 404;
                $result['error'] = true;
                $result['msg']  = 'No data found!';
            endif;
        endif;
        
        echo json_encode($result);
    } 

    function CarCompanyAccApi(){
        header('Content-type: application/json');
        $json_file = file_get_contents('php://input');
		$jsonvalue = json_decode($json_file,true);
        // echo $this->db->last_query();
        if(empty($jsonvalue['email']) || empty($jsonvalue['accreditation_num']) || empty($jsonvalue['accreditation_validity'])):
            $result['code']  = 404;
            $result['error'] = true;
            $result['msg']  = 'Insufficient records in parameter!';
            //$result['data'] = $jsonvalue;
        else:
            $email = $jsonvalue['email'];
            $user_name = $jsonvalue['user_name'];
            $userdata = $this->accapi->isUserExists($email);
            // if($userdata != '' ):
            if(1):
                $saveAcc = array(
                    // 'user_id'   => $userdata['id'],
                    // 'doc_id'    => $userdata['id'],
                    'user_email'=> $email,
                    'user_id'   => 0,
                    'doc_id'    => 0,
                    'doc_name'  => $user_name,
                    'type'      => 'cc', //car company
                    'acc_number'=> $jsonvalue['accreditation_num'],
                    'validity'  => $jsonvalue['accreditation_validity'],
                    'website_of_rb'=> $jsonvalue['website'],
                    'status'    => '1'
                );
                $success = $this->accapi->saveCarCompanyAccreditation($saveAcc);
                $result['code']  = 200;
                $result['error'] = false;
                $result['msg']  = 'Car company accreditation successfully sent.';
                $result['data']  = $success;
            else:
                $result['code']  = 404;
                $result['error'] = true;
                $result['msg']  = 'No data found!';
            endif;
        endif;
        
        echo json_encode($result);
    } 
}