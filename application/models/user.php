<?php
 
class User extends CI_Model {
  
  private $table = 'users';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
  }


  function findOne($user, $password)
  {
    $this->load->database();
    $this->db->where(array('name' => $user, 'password' => $password));
    $query = $this->db->get($this->table)->row();

    if($query){
      $response = array(
        "name" => $user,
        "pass" => $password,
        "admin" => ($query->admin) ? true : false,
        "lastLoggedIn" => $query->lastLoggedIn,
        "createdAt" => $query->createdAt,
        "updatedAt" => $query->updatedAt,
        "id" => $query->id
      );
      $logDate = date("Y-m-d H:i:s");
      $this->db->where("id",$query->id)->update($this->table, array('lastLoggedIn' => $logDate));
      
      return $response;
    }else{
      return false;
    }
    
  }
}