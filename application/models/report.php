<?php
 
class Report extends CI_Model {
  
  private $table = 'reports';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
    $this->load->database();
    $this->load->model('category');
    $this->load->model('log');
    // $this->load->model('report');
    $this->load->model('test');
  }

  //find report by reportId
  function getReports($wherein, $sortBy, $sort = false){
    if($wherein){
      foreach ($wherein as $key => $value) {
        if($key == 'startTime'){
          $this->db->where('STR_TO_DATE(startTime, "%Y-%m-%d") >=', $value);
        } elseif($key == 'endTime'){
          $this->db->where('STR_TO_DATE(endTime, "%Y-%m-%d") <=', $value);
        } else {
          $this->db->where_in($key, $value);
        }
      }
    }

    if($sort){
      $this->db->order_by($sortBy['key'], $sortBy['sortType']);
    } else {
      $this->db->order_by("TestSuite_stt","DESC");
    }

    $result_array = $this->db->get($this->table)->result_array();

    $response = [];

    foreach ($result_array as $query) {
      $time = $this->test->getTimeOfReport(array("report" => $query['id'], "enable" => 1));
      $statusCount = $this->log->getStatus(array("report" => $query['id'], "enable" => 1));
      $response []= array(
        "project" => $query['project'],
        "fileName" => $query['fileName'],
        "startTime" => $time['startTime'],
        "endTime" => $time['endTime'],
        "id" => $query['id'],
        "parentLength" => $statusCount['parentLength'],
        "passParentLength" => $statusCount['passParentLength'],
        "failParentLength" => $statusCount['failParentLength'],
        "errorParentLength" => $statusCount['errorParentLength'],
        "childLength" => $statusCount['childLength'],
        "passChildLength" => $statusCount['passChildLength'],
        "failChildLength" => $statusCount['failChildLength'],
        "errorChildLength" => $statusCount['errorChildLength'],
        "infoChildLength" => $statusCount['infoChildLength'],
      );
    };

    // echo $response;
    return $response;
  }
  
  //find report by reportId
  // function getReports($wherein, $sortBy, $sort = false){
  //   if($wherein){
  //     foreach ($wherein as $key => $value) {
  //       $this->db->where_in($key, $value);
  //     } 
  //   }
  //   if($sort){
  //     $this->db->order_by($sortBy['key'], $sortBy['sortType']);
  //   }
  //   $result_array = $this->db->get($this->table)->result_array();
    
  //   $response = [];

  //   foreach ($result_array as $query) {
  //     $response []= array(
  //       "categories" => $this->category->getCategory(array("report" => $query['id'])),
  //       "project" => $query['project'],
  //       "fileName" => $query['fileName'],
  //       "startTime" => $query['startTime'],
  //       "endTime" => $query['endTime'],
  //       "parentLength" => (int)$query['parentLength'],
  //       "passParentLength" => (int)$query['passParentLength'],
  //       "failParentLength" => (int)$query['failParentLength'],
  //       "fatalParentLength" => (int)$query['fatalParentLength'],
  //       "errorParentLength" => (int)$query['errorParentLength'],
  //       "warningParentLength" => (int)$query['warningParentLength'],
  //       "skipParentLength" => (int)$query['skipParentLength'],
  //       "unknownParentLength" => (int)$query['unknownParentLength'],
  //       "childLength" => (int)$query['childLength'],
  //       "passChildLength" => (int)$query['passChildLength'],
  //       "failChildLength" => (int)$query['failChildLength'],
  //       "fatalChildLength" => (int)$query['fatalChildLength'],
  //       "errorChildLength" => (int)$query['errorChildLength'],
  //       "warningChildLength" => (int)$query['warningChildLength'],
  //       "skipChildLength" => (int)$query['skipChildLength'],
  //       "unknownChildLength" => (int)$query['unknownChildLength'],
  //       "infoChildLength" => (int)$query['infoChildLength'],
  //       "grandChildLength" => (int)$query['grandChildLength'],
  //       "passGrandChildLength" => (int)$query['passGrandChildLength'],
  //       "failGrandChildLength" => (int)$query['failGrandChildLength'],
  //       "fatalGrandChildLength" => (int)$query['fatalGrandChildLength'],
  //       "errorGrandChildLength" => (int)$query['errorGrandChildLength'],
  //       "warningGrandChildLength" => (int)$query['warningGrandChildLength'],
  //       "skipGrandChildLength" => (int)$query['skipGrandChildLength'],
  //       "unknownGrandChildLength" => (int)$query['unknownGrandChildLength'],
  //       "infoGrandChildLength" => (int)$query['infoGrandChildLength'],
  //       "id" => $query['id']
  //     );
  //   };
  //   return $response;
  // }

  //find report by reportId
  function findOne($reportId)
  {
    $this->db->where('id', $reportId);
    $result = $this->db->get($this->table)->result();

    foreach ($result as $query) {
      $response []= array(
          "categories" => $this->category->getCategory(array("report" => $query->id)),
          "project" => $query->project,
          "fileName" => $query->fileName,
          "startTime" => $query->startTime,
          "endTime" => $query->endTime,
          "parentLength" => (int)$query->parentLength,
          "passParentLength" => (int)$query->passParentLength,
          "failParentLength" => (int)$query->failParentLength,
          "fatalParentLength" => (int)$query->fatalParentLength,
          "errorParentLength" => (int)$query->errorParentLength,
          "warningParentLength" => (int)$query->warningParentLength,
          "skipParentLength" => (int)$query->skipParentLength,
          "unknownParentLength" => (int)$query->unknownParentLength,
          "childLength" => (int)$query->childLength,
          "passChildLength" => (int)$query->passChildLength,
          "failChildLength" => (int)$query->failChildLength,
          "fatalChildLength" => (int)$query->fatalChildLength,
          "errorChildLength" => (int)$query->errorChildLength,
          "warningChildLength" => (int)$query->warningChildLength,
          "skipChildLength" => (int)$query->skipChildLength,
          "unknownChildLength" => (int)$query->unknownChildLength,
          "infoChildLength" => (int)$query->infoChildLength,
          "grandChildLength" => (int)$query->grandChildLength,
          "passGrandChildLength" => (int)$query->passGrandChildLength,
          "failGrandChildLength" => (int)$query->failGrandChildLength,
          "fatalGrandChildLength" => (int)$query->fatalGrandChildLength,
          "errorGrandChildLength" => (int)$query->errorGrandChildLength,
          "warningGrandChildLength" => (int)$query->warningGrandChildLength,
          "skipGrandChildLength" => (int)$query->skipGrandChildLength,
          "unknownGrandChildLength" => (int)$query->unknownGrandChildLength,
          "infoGrandChildLength" => (int)$query->infoGrandChildLength,
          "id" => $query->id
        );
    }
    return $response;
  }

  function find($where)
  {
    $this->db->where($where);
    $query = $this->db->get($this->table);

    return $query->result_array();
  }

  //find report by categoryId
  function findCategories($categoryId)
  {
    $this->db->where('category', $categoryId);
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
  
}