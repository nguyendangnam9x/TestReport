<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

//
class Csrf extends REST_Controller
{
    function __construct() {
        parent::__construct(); 
        $this->load->model('test');
        $this->load->model('category');
        $this->load->model('report');
        $this->load->model('log');
        $this->load->model('author');
        $this->load->model('media');
        $this->load->model('node');
        $this->load->model('user');
        $this->load->model('setting');
        $this->load->model('project');

        function getQuery()
        {
            // get the raw POST data
            $rawData = file_get_contents("php://input");

            // this returns null if not valid json
            return json_decode($rawData);
        }

//        if(!$this->check_csrf()) $this->response("invalid token", 400);
    }

    function switchProject_post(){
        $project = getQuery()->project;
        $projectId = array_column($this->project->getProject($project), 'id');

        $array = array(
            "project" => $projectId,
            "projectName" => $project
        );
        $this->session->set_userdata($array);
        $this->response($projectId, 200);
    }

    function detroyReport_post(){
        //TODO: test
        $reportId = getQuery()->query;

        $report = $this->report->findOne($reportId);
        
        $where = array(
            "report" => $reportId, 
        );
        if($report){
            foreach($report as $key){
                //detroy projects if found
                $this->project->detroy(array("id" => $key['project']));
                $this->author->detroy($where);
                $this->category->detroy($where);
                $this->log->detroy($where);
                $this->node->detroy($where);
                $this->test->detroy($where);
                $this->media->detroy($where);
                $this->report->detroy(array("id" => $reportId));
            }
            $this->response(array('status' => 'success', 'message' => 'reportId '.$reportId.' has detroyed!'), 200);
        } else {
            $this->response(array('status' => 'error', 'message' => 'no reportId found!'), 404);
        }
    }

    function dataPointSettings_post(){
        $query = getQuery()->query;

        $settings = array(
            "trendDataPoints" => $query->dataPoints, 
            "trendDataPointFormat" => $query->dataPointFormat,
        );

        foreach ($settings as $key => $value) {
            if(!$key) $settings[$key] = $this->session->userdata($key);
            if(!isset($settings[$key])){
                $settings[$key] = $this->setting->findOne($key)->value;
            }
        }

        //change dashboard to new setting config
        $this->session->set_userdata($settings);
        $this->setting->update($settings);

        $this->response("OK", 200);
    }

    function search_post(){
        $query = getQuery()->query;

        //search from date to date
        $startDate =(!$query->startDate) ? date('Y-m-d', "10/01/1900") : date('Y-m-d', strtotime($query->startDate));
        $endDate = (!$query->endDate) ? date('Y-m-d') : date('Y-m-d', strtotime($query->endDate));
        $regex = $query->regex;
        $status = ($query->status) ? array_filter($query->status) : null;
        $categories = ($query->categories) ? $query->categories : '';
        $checkName = array(
            "regex" => ($regex) ? $regex : "exact",
            "like" => ($query->name) ? $query->name : ''
        );

        //get test object from model
        $test = $this->test->findForSearch($startDate, $endDate, $checkName, $status);

        if($test){
            $out = [];
            $itemsToIterate = count($test);
            
            for ($ix = 0; $ix < $itemsToIterate; $ix++) {
                $out[$ix] = $test[$ix];
                if (count($test[$ix]['logs'])) {
                    $out[$ix]['logs'] = $this->log->getLogsByTestCase($test[$ix]['id']);
                }
                if (count($test[$ix]['categories'])) {
                    $out[$ix]['categories'] = $this->category->getCatsByTestCase($test[$ix]['id']);
                }
                if (count($test[$ix]['nodes'])) {
                    $out[$ix]['nodes'] = $this->node->getNodesWithTestLogs($test[$ix]['id']);
                }
            }
         
            $sendRes = array(
                "query" => $query,
                "tests" => $out,
            );

            $this->response($sendRes, 200);
        } else {
            $this->response(array("status" => "error", "message" => "can not get results"), 404);
        }
    }

    function getTestsForCategory_post(){
        //get id of report (reportId)
        $query = getQuery();
        $input = array(
            "categories" => $query->id
        );

        //find all test by reportId
        $test = $this->test->getTest($input);
        $this->response($test, 200); // 200 being the HTTP response code
    }

    function getCategoryListForReport_post(){
        $query = array(
            "id" => getQuery()->id
        );
        $category = $this->report->findOne($query['id']);

        $this->response($category, 200);
    }

    function details_post(){
        //get id of report (reportId)
        $query = getQuery()->query;
        $input = array(
            "report" => $query->id
        );

        //find all test by reportId
        $test = $this->test->getTest($input);
        $this->response($test, 200); // 200 being the HTTP response code
    }

    function getHistory_post(){
        //get id of report (reportId)
        $query = getQuery()->query;
        $input = array(
            'name' => $query->name,
            'report !=' => $query->id
        );
        
        //find all test by reportId
        $test = $this->test->getTest($input);

        $this->response($test, 200); // 200 being the HTTP response code
    }

    function getTestsById_post(){
        //get id of report (reportId)
        $query = getQuery()->query;
        $input = array(
            "id" => $query->id
        );
        
        //find all test by reportId
        $test = $this->test->getTest($input);

        $this->response($test[0], 200); // 200 being the HTTP response code
    }
    function login_post(){
        $query = getQuery()->query;
        $user = $this->user->findOne($query->name, $query->password);

        if($user){
            $this->session->set_userdata('authenticated', true);
            $this->session->set_userdata('user', $user);
            $this->response(array("user"=>$user, "isLoggedIn" => true), 200);
        } else {
            $this->response("Unauthorized", 401);
        }
    }

    function themeSetting_post(){
        $query = getQuery()->theme;
        $session = $this->session->userdata('theme');
        $allSession = $this->session->all_userdata();

        if($session == $query){
            $this->session->set_userdata(array(
                "theme" => ''
            ));
        } else {
            $this->session->set_userdata(array(
                "theme" => $query
            ));
        }
        $this->response("OK",200);
    }

    function updateUser_get(){
        $this->load->database();

        $data = array(
           'testcase' => $this->get('testcase'),
           'data' => $this->get('data'),
           'value' => $this->get('value')
        );

        $data = array(
                   'title' => $title,
                   'name' => $name,
                   'date' => $date
                );

        $this->db->where('id', $id);
        $this->db->update('mytable', $data);

        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

    function updateStep_post(){
        $query = getQuery()->query;
        $update = array(
           'status' => $query->status,
           'details' => $query->details,
        );
        $data = $this->log->update(array("id"=>$query->id), $update);

        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response(array('error' => 'Can not update'), 404);
        }
    }


    function reports_get(){
        $authen = $this->session->userdata('authenticated');
        $data = array(
           'startTime' => date('Y-m-d', $this->get('startdate')/1000),
           'endTime' => date('Y-m-d', $this->get('enddate')/1000),
           'project' => $this->get('projectid'),
        );

        //query all reports
        $reports = $this->report->getReports($data, ['key'=>'startTime', 'sortType' => 'desc']);

        $view = array(
            "reports"=> $reports,
            "data" => $data
        );
        
        if($authen)
        {
            $this->response($view, 200); // 200 being the HTTP response code
        }else{
            $this->response(array("error" => "can not retrieve data"), 404);
        }
    }
}
