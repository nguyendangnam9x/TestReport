<?php
 
class Node extends CI_Model {
  
  private $table = 'nodes';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
  }

  function getNodesWithTestLogs($testid){
    $this->db->where('test', $testid);
    $nodeArray = $this->db->get($this->table)->result_array();

    $itemsToIterateIn = count($nodeArray);

    if($itemsToIterateIn){
      for($ix = 0; $ix < $itemsToIterateIn; $ix++){
        //TODO: check getLogs
        $nodeArray[$ix]['logs'] = $this->log->getLogs($nodeArray[$ix]['id']);
      }
    }
    
    return $nodeArray;
  }

  function find($where)
  {
    $this->db->where($where);
    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  function get_project()
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