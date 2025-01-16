<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate_model extends CI_Model {
	public  function select_certificate_template($category,$temp_no){ 
	
	if($category=='Portrait'){
			$temp_p1 = array("PS1-07","PS2-07","PS3-07","PS4-07",
							"PS1-08","PS2-08","PS3-08","PS4-08",
							"PS1-09","PS2-09","PS3-09","PS4-09",
							"PS1-10","PS2-10","PS3-10","PS4-10",
							"PS1-11","PS2-11","PS3-11","PS4-11",
							"PS1-12","PS2-12","PS3-12","PS4-12");
			if (in_array($temp_no,$temp_p1)){
				$path ='templates/certificate_template/portrait/template1';
				return $path;
			}
			$temp_p2 = array("PS1-01","PS2-01","PS3-01","PS4-01",
							"PS1-02","PS2-02","PS3-02","PS4-02",
							"PS1-03","PS2-03","PS3-03","PS4-03",
							"PS1-04","PS2-04","PS3-04","PS4-04",
							"PS1-05","PS2-05","PS3-05","PS4-05",
							"PS1-06","PS2-06","PS3-06","PS4-06");
			if (in_array($temp_no,$temp_p2)){
				$path ='templates/certificate_template/portrait/template2';
				return $path;
			}
			$temp_p3 = array("PS1-13","PS2-13","PS3-13","PS4-13",
							"PS1-14","PS2-14","PS3-14","PS4-14",
							"PS1-15","PS2-15","PS3-15","PS4-15",
							"PS1-16","PS2-16","PS3-16","PS4-16",
							"PS1-17","PS2-17","PS3-17","PS4-17",
							"PS1-18","PS2-18","PS3-18","PS4-18");
			if (in_array($temp_no,$temp_p3)){
				$path ='templates/certificate_template/portrait/template3';
				return $path;
			}else{

				$path ='templates/certificate_template/portrait/template1';
				return $path;
			}

		}else{

			$temp_l1 = array("LS1-02","LS2-02","LS3-02","LS4-02",
							"LS1-03","LS2-03","LS3-03","LS4-03",
							"LS1-04","LS2-04","LS3-04","LS4-04",
							"LS1-05","LS2-05","LS3-05","LS4-05",
							"LS1-06","LS2-06","LS3-06","LS4-06",
							"LS1-07","LS2-07","LS3-07","LS4-07");
			if (in_array($temp_no,$temp_l1)){
				$path ='templates/certificate_template/landscape/template1'; //2logo right side
				return $path;
			}
			$temp_l2 = array("LS1-20","LS2-20","LS3-20","LS4-20",
							"LS1-21","LS2-21","LS3-21","LS4-21",
							"LS1-22","LS2-22","LS3-22","LS4-22",
							"LS1-23","LS2-23","LS3-23","LS4-23",
							"LS1-24","LS2-24","LS3-24","LS4-24",
							"LS1-25","LS2-25","LS3-25","LS4-25",);
			if (in_array($temp_no,$temp_l2)){
				$path ='templates/certificate_template/landscape/template2'; //2logo diffrent side
				return $path;
			}
			$temp_l3 = array("LS1-08","LS2-08","LS3-08","LS4-08",
							"LS1-09","LS2-09","LS3-09","LS4-09",
							"LS1-10","LS2-10","LS3-10","LS4-10",
							"LS1-11","LS2-11","LS3-11","LS4-11",
							"LS1-12","LS2-12","LS3-12","LS4-12",
							"LS1-13","LS2-13","LS3-13","LS4-13");   
			if (in_array($temp_no,$temp_l3)){
				$path ='templates/certificate_template/landscape/template3'; //2big corner right side logo
				return $path;
			}
			$temp_l4 = array("LS1-14","LS2-14","LS3-14","LS4-14",
							"LS1-15","LS2-15","LS3-15","LS4-15",
							"LS1-16","LS2-16","LS3-16","LS4-16",
							"LS1-17","LS2-17","LS3-17","LS4-17",
							"LS1-18","LS2-18","LS3-18","LS4-18",
							"LS1-19","LS2-19","LS3-19","LS4-19");
			if (in_array($temp_no,$temp_l4)){
				$path ='templates/certificate_template/landscape/template4'; //zig zag 2logo diffrent side
				return $path;

				}
			$temp_l5 = array("LS1-01","LS2-01","LS3-01","LS4-01");
			if (in_array($temp_no,$temp_l5)){
				$path ='templates/certificate_template/landscape/template5'; //square box 2logo diffrent side
				return $path;
			}else{
				$path ='templates/certificate_template/landscape/template1'; //diffrent certificate
				return $path;
				}

		}

	} 
	public  function get_template_info_by_course($id){ 

 		$this->db->select('ct.id,ct.template_no,ct.bg_image,ct.text_image,uc.*');
		$this->db->from('tbl_user_certificate uc');
		$this->db->join('tbl_certificate_template ct', 'uc.templete_id = ct.id');  
		$this->db->where('uc.course_id ', $id); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	public  function select_certificate_template_pdf($category,$temp_no){ 
	
	if($category=='Portrait'){
			$temp_p1 = array("PS1-07","PS2-07","PS3-07","PS4-07",
							"PS1-08","PS2-08","PS3-08","PS4-08",
							"PS1-09","PS2-09","PS3-09","PS4-09",
							"PS1-10","PS2-10","PS3-10","PS4-10",
							"PS1-11","PS2-11","PS3-11","PS4-11",
							"PS1-12","PS2-12","PS3-12","PS4-12");
			if (in_array($temp_no,$temp_p1)){
				$path ='templates/certificate_template/portrait/pdf1';
				return $path;
			}
			$temp_p2 = array("PS1-01","PS2-01","PS3-01","PS4-01",
							"PS1-02","PS2-02","PS3-02","PS4-02",
							"PS1-03","PS2-03","PS3-03","PS4-03",
							"PS1-04","PS2-04","PS3-04","PS4-04",
							"PS1-05","PS2-05","PS3-05","PS4-05",
							"PS1-06","PS2-06","PS3-06","PS4-06");
			if (in_array($temp_no,$temp_p2)){
				$path ='templates/certificate_template/portrait/pdf2';
				return $path;
			}
			$temp_p3 = array("PS1-13","PS2-13","PS3-13","PS4-13",
							"PS1-14","PS2-14","PS3-14","PS4-14",
							"PS1-15","PS2-15","PS3-15","PS4-15",
							"PS1-16","PS2-16","PS3-16","PS4-16",
							"PS1-17","PS2-17","PS3-17","PS4-17",
							"PS1-18","PS2-18","PS3-18","PS4-18");
			if (in_array($temp_no,$temp_p3)){
				$path ='templates/certificate_template/portrait/pdf3';
				return $path;
			}else{

				$path ='templates/certificate_template/portrait/pdf1';
				return $path;
			}

		}else{

			$temp_l1 = array("LS1-02","LS2-02","LS3-02","LS4-02",
							"LS1-03","LS2-03","LS3-03","LS4-03",
							"LS1-04","LS2-04","LS3-04","LS4-04",
							"LS1-05","LS2-05","LS3-05","LS4-05",
							"LS1-06","LS2-06","LS3-06","LS4-06",
							"LS1-07","LS2-07","LS3-07","LS4-07");
			if (in_array($temp_no,$temp_l1)){
				$path ='templates/certificate_template/landscape/pdf1'; //2logo right side
				return $path;
			}
			$temp_l2 = array("LS1-20","LS2-20","LS3-20","LS4-20",
							"LS1-21","LS2-21","LS3-21","LS4-21",
							"LS1-22","LS2-22","LS3-22","LS4-22",
							"LS1-23","LS2-23","LS3-23","LS4-23",
							"LS1-24","LS2-24","LS3-24","LS4-24",
							"LS1-25","LS2-25","LS3-25","LS4-25",);
			if (in_array($temp_no,$temp_l2)){
				$path ='templates/certificate_template/landscape/pdf2'; //2logo diffrent side
				return $path;
			}
			$temp_l3 = array("LS1-08","LS2-08","LS3-08","LS4-08",
							"LS1-09","LS2-09","LS3-09","LS4-09",
							"LS1-10","LS2-10","LS3-10","LS4-10",
							"LS1-11","LS2-11","LS3-11","LS4-11",
							"LS1-12","LS2-12","LS3-12","LS4-12",
							"LS1-13","LS2-13","LS3-13","LS4-13");   
			if (in_array($temp_no,$temp_l3)){
				$path ='templates/certificate_template/landscape/pdf3'; //2big corner right side logo
				return $path;
			}
			$temp_l4 = array("LS1-14","LS2-14","LS3-14","LS4-14",
							"LS1-15","LS2-15","LS3-15","LS4-15",
							"LS1-16","LS2-16","LS3-16","LS4-16",
							"LS1-17","LS2-17","LS3-17","LS4-17",
							"LS1-18","LS2-18","LS3-18","LS4-18",
							"LS1-19","LS2-19","LS3-19","LS4-19");
			if (in_array($temp_no,$temp_l4)){
				$path ='templates/certificate_template/landscape/pdf4'; //zig zag 2logo diffrent side
				return $path;

				}
			$temp_l5 = array("LS1-01","LS2-01","LS3-01","LS4-01");
			if (in_array($temp_no,$temp_l5)){
				$path ='templates/certificate_template/landscape/pdf5'; //square box 2logo diffrent side
				return $path;
			}else{
					$path ='templates/certificate_template/landscape/pdf1'; //diffrent certificate
					return $path;
				}

		}

	} 
}



?>