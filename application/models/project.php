<?php
 
class Project extends CI_Model {
  
  private $table = 'projects';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
  }
  
  // Project.find({ name: project }).exec(function(err, projects) {
  //     if (projects.length && projects.length === 1) project = projects[0].id;
      
  //     $query.find({ project: project }).sort({ startTime: 'desc' }).exec(function(err, result) {
  //         if (err) console.log(err);

  function find($item)
  {
    $this->db->order_by('createdAt', 'DESC');
    $this->db->where('name', $item);
    $this->db->where('enable', '1');
    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  function getProject($project)
  {
    $this->db->select(array('id', 'name'));
    $this->db->order_by('id', 'ASC');
    $this->db->where('enable', '1');
    
    if($project){
      $this->db->where('name', $project);
      $this->db->where('enable', '1');
    }

    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  function get_last_item()
  {
    $this->db->order_by('id', 'DESC');
    $this->db->where('enable', '1');
    $query = $this->db->get($this->table, 1);
    
    return $query->result();
  }
  
  
  function insert_item($item)
  {
    $this->item = $item;
    
    $this->db->insert($this->table, $this);
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