<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadimage extends CI_Controller {

	public function index()
	{


		$config['upload_path'] = './assets/images/uploads';
          $config['allowed_types'] = 'gif|jpg|png';
          $this->load->library('upload', $config);
          $field_name = 'file';
          $this->upload->do_upload($field_name);
          $thumb=$this->upload->data();
          $response = new StdClass;
          $response->link = base_url()."assets/images/uploads/".$thumb['file_name'];
          echo stripslashes(json_encode($response));
	}
}