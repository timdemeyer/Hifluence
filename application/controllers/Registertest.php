<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registertest extends CI_Controller {

	public function index() // Register
    {
    	$data["message"] = "success";
    	$data["email"] = "tim315859@hotmail.com";
    	$this->load->view('view_success',$data);
    }

}
