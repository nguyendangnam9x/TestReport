<?php
 
class Media extends CI_Model {
  
  private $table = 'media';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
  }

  function find($where)
  {
    $this->db->where($where);
    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  function get_report($itemid)
  {
    $this->db->where('id', $itemid);
    $query = $this->db->get($this->table);

    return $query->row();
  }

  function get_all_report()
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