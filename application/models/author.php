<?php
 
class Author extends CI_Model {
  
  private $table = 'authors';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
  }
  
  function getNames()
  {
    $query = $this->db->select('name')->get($this->table)->result_array();

    return array_column($query,'name');
  }

  function getAuthor($where)
  {
    $this->db->where($where);
    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  function get_all()
  {
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  function get_last_item()
  {
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get($this->table, 1);
    
    return $query->result();
  }
  
  
  function insert_item($item)
  {
    $this->item = $item;
    
    $this->db->insert($this->table, $this);
  }

  function remove_item($itemid)
  {
    $this->db->delete($this->table, array('id' => $itemid));
  }

  function destroy($where)
  {
    $this->db->delete($this->table, $where);
  }
  
  function get_row_count()
  {
    return $this->db->count_all($this->table);
  }

  //get all project
  //getProjects

}