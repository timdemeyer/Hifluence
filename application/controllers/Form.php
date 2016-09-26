<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

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
    	//$data['comments'] = $this->User_model->getComments(); // add user id
	
    	// AUTOCOMPLETE FORM WITH PASSWORD FROM SESSION?
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('view_form');
        }
        else
        {
            $this->load->view('view_form');
        }
     
    }

    // LOGIN -------------------------------------------------------------------------------------

    public function login()
    {

    	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    	$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

    	if ($this->form_validation->run() == FALSE) { 
    		if(isset($this->session->userdata['logged_in']))
    		{
    			$this->load->view('view_admin'); // session found
    		}
    		else
    		{
    			$this->load->view('view_form'); // no session
    		}
    	} 
    	else // CREATE SESSION
    	{
    		$data = array(
    			'username' => $this->input->post('username'),
    			'password' => do_hash($this->input->post('password'))
    			);
    		$result = $this->User_model->login($data);

    		if ($result == TRUE) { // password & username match
    			// Remember me checkbox
		    	$remember = $this->input->post('remember_me');
				if($remember)
				{
					$this->session->set_userdata('remember_me', true);
				}
    			$username = $this->input->post('username');
    			$result = $this->User_model->read_user_information($username);
    			if ($result != false) {
    				$session_data = array(
    					'username' => $result[0]->Username,
    					'email' => $result[0]->Email,
    					'profileimage' => $result[0]->ProfileImage
    					);
					// Add user data in session
    				$this->session->set_userdata('logged_in', $session_data);
    				$data['sessiondata'] = $session_data;
					$data['userdata'] = $result;
					$userid = $data['userdata'][0]->PK_UserId;
    				$data['usertags'] = $this->User_model->getUserTags($userid);
    				$data['comments'] = $this->User_model->getComments(); // add user id
    				$this->load->view('view_admin',$data);
    			}
    		} 
    		else {
    			$data["colortype"] = "errormessage";
    			$data["message"] = "Invalid Username or Password";
    			$this->load->view('view_form', $data);
    		}
    	}    	
    }

    // LOGOUT -------------------------------------------------------------------------------------

    public function logOut()
    {
		// Removing session data
		$this->session->sess_destroy();
/*
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
*/
		$data['colortype'] = "successmessage";
		$data['message'] = 'Successfully Logged out.';
		$this->load->view('view_form', $data);    	
		// go to success and redirect?
    }

    // REGISTER NEW USER --------------------------------------------------------------------------

	public function register()
	{
		
		// _post variables 
		$username = $this->input->post('reg-username');
		$email = $this->input->post('reg-email');
		$password = $this->input->post('reg-password');
		$passwordhash = do_hash($password); // SHA1
		$profileImage = str_replace(' ', '_', $_FILES['userfile']['name'][0]); // [0] -> single image upload, only insert first image name of array in db

		// check if email already exists in database
		if($this->User_model->checkExistence($email))
		{
			// already exists
			
			// TODO 
			// resend data into fields
			$data["message"] = "The email address you have entered is already registered.";
			$this->load->view('view_form',$data);
		}
		else // email still available
		{
			$data = array(
	                'Username' => $username,
	                'Email' => $email,
	                'Password' => $passwordhash,
	            	'ProfileImage' => $profileImage
	            );

			if($this->uploadImage()){
				$data["userid"] = $this->User_model->createUser($data);		
				$data["taglist"] = $this->User_model->getAvailableTags();
				$data["colortype"] = "successmessage";
				$data["message"] = "Registration Successfully";
				$data["email"] = $email;
				//$data = array('upload_data' => $this->upload->data());
				$this->load->view('view_success',$data);
			}
		}
	}

    // UPLOAD PROFILE IMAGE ------------------------------------------------------------------------

	public function uploadImage(){
		$config = array(
			'upload_path' => "./public/img/profile_images",
			'allowed_types' => "gif|jpg|png|jpeg",
			'overwrite' => TRUE,
			'max_size' => "2048000", // 2 MB(2048 Kb)
			'max_height' => "2048",
			'max_width' => "2048"
			);
		$this->load->library('upload', $config);

	    $files = $_FILES;
	    $cpt = count($_FILES['userfile']['name']);

	    for($i=0; $i<$cpt; $i++)
	    {           
	        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
	        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
	        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
	        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
	        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

			if($this->upload->do_upload())
			{
				return true; // create user in db
			}
			else
			{
				$data["colortype"] = "errormessage"; 			
				$data["message"] = $this->upload->display_errors();
				$this->load->view('view_form',$data);
				return false; // do not create new user
			}
	    }
	}

    // ADD COMMENT TO USER PROFILE ----------------------------------------------------------------

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
		$this->index();
		// if logged in facebook => view_admin_facebook
		// if session login => view_admin
    }

    // API GET JSON DATA (tags) FROM DATABASE ------------------------------------------------------

	public function getjsondata() {

		$data = $this->User_model->getjsondata();

	    //header('Content-Type: application/json');
	    $jsondata = json_encode($data->result());
	    
	    print_r($jsondata);
	    return $data;
	}

	// ADD TAG TO PROFILE --------------------------------------------------------------------------
/*
	public function addTag()
	{
		$tag = $this->input->post('selectedtag');
		$email = $this->input->post('hid_email');

		$this->User_model->addTag($tag,$email);
		$data["colortype"] = "successmessage";
		$data["message"] = "Your tag has been succesfully added to your profile! You can now log in the form below.";
		$this->load->view('view_form',$data);
	}	
*/
	public function addUserTags()
	{
		$arrTags = $this->input->post('colors[]');
		$userEmail = $this->input->post('hid_userid');

		$this->User_model->addUserTags($arrTags,$userEmail);
		$data["colortype"] = "successmessage";
		$data["message"] = "Your tags have been succesfully added to your profile! You can now log in the form below.";
		$this->load->view('view_form',$data);
	}

	// END -----------------------------------------------------------------------------------------

}