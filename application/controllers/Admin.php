<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function index()
    {
    	$username = "Tim"; // GET FROM SESSION !!!
    	$data['userdata'] = $this->User_model->read_user_information($username);
    	$data['comments'] = $this->User_model->getComments(); // add user id
		$this->load->view('view_admin',$data);
    }

    public function addComment()
    {
    	$name = $this->input->post('Name');
    	$comment = $this->input->post('Comment');
    	$date = date('Y-m-d');
		$data = array(
	                'Name' => $name,
	                'Comment' => $comment,
	                'Date' => $date
	            );
		$this->User_model->addComment($data);	
		// check if user is logged in with facebook or database
		if($this->input->post('facebook') !="")
		{
			$data['comments'] = $this->User_model->getComments(); // add user id
			$this->load->view('view_admin_facebook',$data);
		}
		else{
			$this->index();
    	}
    }
 
}