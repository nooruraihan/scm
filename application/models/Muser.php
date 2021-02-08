<?php 
class Muser extends CI_Model{

   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	    $this->load->database();
    }
    function emailallCheck($email)
    {
        $this->db->select('user_id');	
        $this->db->from('users');
        $this->db->where('email',$email);
        $query = $this->db->get();
        $results=$query->num_rows();  
        
        return $results; 
    }
    public function insert_user($data){
        $this->db->insert('users',$data);
        return $this->db->insert_id();
   }
   function alllogins($username){
    $this->db->select('user_id,first_name,user_name, password, salt');	
    $this->db->from('users');
    $this->db->where('user_name', $username);
    $this->db->or_where('user_id',$username);
    $query = $this->db->get();
    return $query->row(); 
}
function getuserById($user_id)
{
$this->db->select('user_id,first_name,user_name,last_name,email,gender,dateofbirth,image');
$this->db->from('users');
$this->db->where('user_id', $user_id);
$query = $this->db->get();

return $query->row();
}
public function update_user($userid,$fields)
{
$this->db->where('user_id', $userid);
$this->db->update('users', $fields);
return true;
}
}