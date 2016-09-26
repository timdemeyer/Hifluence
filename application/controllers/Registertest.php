<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registertest extends CI_Controller {

	public function index() // Register
    {
    	$data["message"] = "success";
    	$data["userid"] = "28";
    	$data["taglist"] = $this->User_model->getAvailableTags();
    	$this->load->view('view_success',$data);
    }

}
