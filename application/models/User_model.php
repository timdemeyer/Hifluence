<?php

Class User_model extends CI_Model
{

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

	// ---------------------------------------------------------------------------------------

	function createUser($data)
	{
		$this->db->insert('tbl_users', $data);
		$insert_id = $this->db->insert_id();
	    return  $insert_id;
	}

	// ---------------------------------------------------------------------------------------

	function checkExistence($email)
	{
		$this->db->where('Email',$email);
	    $query = $this->db->get('tbl_users');
	    if ($query->num_rows() > 0){
	        return true; // match -> email exists already
	    }
	    else{
	        return false; // no match -> still available
	    }		
	}

	// ---------------------------------------------------------------------------------------

	function login($data)
	{
		$condition = "Username =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . $data['password'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
		return true;
		} else {
		return false;
		}
	}

	// ---------------------------------------------------------------------------------------

	function read_user_information($username)
	{
		$condition = "Username =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} 
		else {
			return false;
		}
	}

	// ---------------------------------------------------------------------------------------

	function getComments() // add user id
	{
		return $this->db->query("SELECT * FROM `tbl_comments` ORDER BY `PK_CommentID` DESC");
	}

	// ---------------------------------------------------------------------------------------

	function addComment($data)
	{
		return $this->db->insert('tbl_comments', $data);
	}

	// ---------------------------------------------------------------------------------------

	function getjsondata()
	{
		return $this->db->query("SELECT Json FROM `tbl_json` WHERE PK_JsonId = 1");
	}

	// ---------------------------------------------------------------------------------------

	function getAvailableTags()
	{
		return $this->db->get('tbl_tags');
	}

	// ---------------------------------------------------------------------------------------

	function addUserTags($arrTags,$userid)
	{
	    $N = count($arrTags);

	    for($i=0; $i < $N; $i++) // insert selected courses and link to a specific student
	    {
	    	$this->db->query("INSERT INTO `tbl_usertags`(`FK_UserId`, `FK_TagId`) VALUES ('".$userid."','".$arrTags[$i]."')");
	    }
	}

	// ---------------------------------------------------------------------------------------
	
	function getUserTags($userid)
	{
		return $this->db->query("SELECT `Tagname` FROM `tbl_tags` JOIN `tbl_usertags` ON tbl_tags.PK_TagId=tbl_usertags.FK_TagId WHERE `FK_UserId` ='" . $userid . "'");
	}

	// ---------------------------------------------------------------------------------------

}

?>