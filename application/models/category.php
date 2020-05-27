<?php
 
class Category extends CI_Model {
    
  private $table = 'categories';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
  }

  function getCatsByTestCase($itemid)
  {
    $this->db->where('test', $itemid);
    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  function getCategory($where)
  {
    $this->db->where($where);
    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  function getNames()
  {
    
    $this->db->distinct();
    $query = $this->db->select('name')->get($this->table)->result_array();

    return array_column($query,'name');
  }

  function getGroupsWithCounts($matcher, $groupby){
    $response = array(
      "match" => $matcher,
      "group" => array(
        "_id" => $groupby,
        "count" => array("sum" => 1), 
        ),
      );
    return $response;
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