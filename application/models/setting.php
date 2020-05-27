<?php
 
class Setting extends CI_Model {
  
  private $table = 'settings';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
  }

  function findOne($item)
  {
    $this->db->where('setting',$item);
    $query = $this->db->get($this->table)->row();

    if($query) return $query;
    else return false;
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

  function update($data)
  {
    foreach ($data as $key => $value) {
      $this->db->where('setting', $key);
      $this->db->update($this->table, array('value' => $value));
    }
    return "OK";
  }
}