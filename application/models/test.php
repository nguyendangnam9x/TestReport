<?php
 
class Test extends CI_Model {
  
  private $table = 'tests';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
    $this->load->model('log');
    $this->load->model('category');
    $this->load->model('media');
    $this->load->model('node');
    $this->load->model('author');
    $this->load->model('category');
  }

  function getGroupsWithCounts($matcher, $groupby, $sortBy, $limit){
    $this->db->select(['name', 'status', 'count(name) as count']);
    foreach ($matcher as $key=>$value) {
      $this->db->where_in($key, $value);
    }
    $this->db->group_by($groupby);
    $this->db->order_by($sortBy['key'], $sortBy['sortType']);
    $this->db->limit($limit);

    $query = $this->db->get($this->table)->result_array();
    
    $return = [];
    
    foreach ($query as $key) {
      $id = [];
      foreach ($groupby as $group) {
        $id[$group] = $key[$group];
      }

      $return []= array(
        "_id" => $id,
        "count" => (int)$key['count']
      );
    }

    return $return;
  }

  function find($where){
    $this->db->where($where);
    $result = $this->db->get($this->table);

    return $result->result_array();
  }
  
  function getTest($where){
    $this->load->model('report');
    $this->db->where($where);
    $this->db->order_by('startTime', 'ASC');
    $test = $this->db->get($this->table)->result_array();
    $out = [];

    foreach ($test as $key) {
        $data = array(
            "report" => $key['report'],
            "test" => $key['id'], 
        );

        $logs = $this->log->getLog($data);
        $media = $this->media->find($data);
        $nodes = $this->node->find($data);
        $categories = $this->category->getCategory($data);
        $author = $this->author->getAuthor($data);
        $report = $this->report->findOne($key['report']);

        $out []= array(
          "nodes" => $nodes,
          "logs" => $logs,
          "media" => $media,
          "categories" => $categories,
          "authors" => $author,
          "report" => $report,
          "name" => $key['name'],
          "status" => $this->log->getTestStatus(array("test" => $key['id']), array("status" => $key['status'])),
          // "status" => $key['status'],
          "description" => $key['description'],
          "startTime" => $key['startTime'],
          "endTime" => $key['endTime'],
          "childNodesCount" => (int)$key['childNodesCount'],
          "ip" => $key['Testcase_ip'],
          "hostname" => $key['Testcase_hostname'],
          "author" => $key['authors'],
          "id" => $key['id']
        );
    }

    return $out;
  }

  function getTimeOfReport($where){
    $this->db->select("startTime, endTime");
    $this->db->where($where);
    $result = $this->db->get($this->table)->result_array();

    $listStartTime = array_map(function($i){return $i['startTime'];}, $result);
    usort($listStartTime, function($a, $b){return strtotime($a) - strtotime($b);});

    $listEndTime = array_map(function($i){return $i['endTime'];}, $result);
    usort($listEndTime, function($a, $b){return strtotime($b) - strtotime($a);});

    $response = array("startTime" => $listStartTime[0], "endTime" => $listEndTime[0]);
    return $response;
  }

  function getTests($testIds){
    $this->load->model('report');
    $this->db->whereIn('id', $testIds);
    $result = $this->db->get($this->table)->result_array();

    $response = [];
    foreach ($result as $query) {
      $key = array(
        "media" => array(),
        "authors" => array(),
        "nodes" => array(),
        "report" => $this->report->findOne($query['report']),
        "logs" => $this->log->findOne($query['log']),
        "categories" => $this->category->getCategory($query['category']),
        "name" => $query['name'],
        "bdd" => $query['bdd'],
        "bddType" => $query['bddType'],
        "ip" => $query['Testcase_ip'],
        "hostname" => $query['Testcase_hostname'],
        "author" => $query['authors'],
        "status" => $this->log->getTestStatus(array("test" => $query['id'])),
        "categorized" => $query['categorized'],
        "description" => $query['description'],
        "warnings" => $query['warnings'],
        "startTime" => $query['startTime'],
        "endTime" => $query['endTime'],
        "childNodesCount" => $query['childNodesCount']
      );
      $response []= $key;
    }
    $this->db->where(array("startDate" => $startDate, "endDate" => $endDate, "status" => $status));
    return $response;
  }

  function findForSearch($startDate, $endDate, $name, $status){

    $this->db->where("date(startTime) >=", date("Y-m-d", strtotime($startDate)));
    $this->db->where("date(endTime) <", date("Y-m-d", strtotime($endDate.' +1 day')));

    if ($name['regex'] == 'exact'){
      $this->db->where("name", $name['like']);
    } elseif ($name['regex'] == 'endsWith'){
      $this->db->like("name", $name['like'], before);
    } elseif ($name['regex'] == 'startsWith'){
      $this->db->like("name", $name['like'], after);
    } elseif ($name['regex'] == 'contains'){
      $this->db->like("name", $name['like']);
    } elseif ($name['regex'] == 'except'){
      $this->db->not_like("name", $name['like']);
    }

    if($status){
      $this->db->where_in("status", $status);
    }

    $response = $this->db->get($this->table)->result_array();
    return $response;
  }

  function destroy($where)
  {
    $this->db->delete($this->table, $where);
  }
  
  function updateStatus($where, $status){
    $update = array(
      "status" => $status
    );
    $this->db->where('id', $where['test']);
    $result = $this->db->update($this->table, $update);
    return $result;
  }
}