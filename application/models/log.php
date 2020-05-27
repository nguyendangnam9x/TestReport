<?php
 
class Log extends CI_Model {
  
  private $table = 'logs';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
  }

  function getGroupsWithCounts($matcher, $groupby)
  {
    $this->db->where('id', $itemid);
    $query = $this->db->get($this->table);

    $response = array(
      "match" => $matcher,
      "group" => array(
          "_id" => $groupby,
          "count" => array(
              "sum" => 1
            )
        ),
      );
    return $query->result_array();
  }

  function getTestStatus($where, $currentStatus){
    $this->db->select("status")->where($where);
    $query = $this->db->get($this->table)->result_array();
    $map = array_map(function($i){return $i['status'];}, $query);
    $status = (in_array('error', $map) || in_array('fail', $map)) ? 'fail' : 'pass';
    if($currentStatus['status'] !== $status){
      $this->test->updateStatus($where, $status);
    }
    return $status;
  }

  function getStatus($where){
    $sql = "select status, test, COUNT(*) as 'count'
      from `logs` 
      where `report` = ? and `enable` = 1
      group by CONCAT(test, '_', status);";
    $queryGroupByTest = $this->db->query($sql, array($where['report']))->result_array();

    $keyval = '';
    $parentLength = 1;
    $passParentLength = 0;
    $failParentLength = 0;
    $errorParentLength = 0;
    $childLength = 0;
    $passChildLength = 0;
    $failChildLength = 0;
    $errorChildLength = 0;
    $infoChildLength = 0;

    foreach ($queryGroupByTest as $key => $value) {
      $childLength += $value['count']; //$value->count;
      if(($value['status'] == 'pass')){
          $passChildLength += $value['count'];
      } elseif($value['status'] == 'fail'){
          $failChildLength += $value['count'];
      } elseif($value['status'] == 'error'){
          $errorChildLength += $value['count'];
      } elseif($value['status'] == 'info'){
          $infoChildLength += $value['count'];
      };
    }

    $countFilterQuery = array_unique(array_map(function($i){return $i['test'];}, $queryGroupByTest));

    foreach ($countFilterQuery as $value) {
      $statusEachReport = array_map(function($i) use ($value){if($i['test'] == $value){ return $i['status']; }}, $queryGroupByTest);
      if(in_array('fail', $statusEachReport)){
        $failParentLength += 1;
      } else if (in_array('error', $statusEachReport)) {
        $errorParentLength += 1;
      }
    }

    $response = array(
      "parentLength" => count($countFilterQuery),
      "passParentLength" => count($countFilterQuery) - $failParentLength - $errorParentLength,
      "failParentLength" => $failParentLength,
      "errorParentLength" => $errorParentLength,
      "childLength" => $childLength,
      "passChildLength" => $passChildLength,
      "failChildLength" => $failChildLength,
      "errorChildLength" => $errorChildLength,
      "infoChildLength" => $infoChildLength,
    );

    return $response; 
  }

  function getLog($where)
  {
    $this->db->where($where);
    $this->db->order_by('timestamp', 'DESC');
    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  function getLogsByTestCase($itemid)
  {
    $this->db->where('test', $itemid);
    $query = $this->db->get($this->table);

    return $query->result_array();
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
  
  function update($where, $data){
    $this->db->where($where);
    $result = $this->db->update($this->table, $data);
    return $where;
  }
}