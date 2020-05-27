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
class Api extends REST_Controller
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
    }

    function checkSession_get(){
        $cookie = get_cookie();
        $session = $this->session->all_userdata();
        $csrf = $this->session->userdata('csrfSecret');
        $headers = apache_request_headers();
        $headerCsrf = ($headers['X-CSRF-Token']) ? $headers['X-CSRF-Token'] : "";
        $csrfStatus = ($headerCsrf == $csrf) ? "pass" : "not pass";

        $response = array(
            "csrfStatus" => $csrfStatus,
            "csrf" => $csrf,
            "session" => $session,
            "headers" => $headers,
            "headerCsrf" => array(
                "X-CSRF-Token" => $headerCsrf
            ) 
        );
        $this->response($response, 200);
    }

    function csrfToken_get(){
        //TODO: watch out this code, take your own risks
        // $csrf = $this->session->userdata('csrfSecret');
        
        $data = array(
            "_csrf" => $this->security->get_csrf_hash(),
        );
        $this->response($data, 200);
    }

    function aggregates_get(){
        $authen = $this->session->userdata('authenticated');
        $status = '';
        $name = '';
        $count = 0;

        //get setting values
        $settings = array(
            'trendDataPoints' => '5',
            'trendDataPointFormat' => 'num'
        );

        foreach ($settings as $key => $value) {
            $settings[$key] = $this->session->userdata($key);
            if(!isset($settings[$key]) or !$settings[$key]){
                $settings[$key] = $this->setting->findOne($key)->value;
            }
        }

        $parentCount = 0;
        $parentPassed = 0;
        $parentFailed = 0;
        $parentErrored = 0;
        $childCount = 0;
        $childPassed = 0;
        $childFailed = 0;
        $childErrored = 0;
        $topPassed = $topFailed = $categories = [];

        $currentProject = $this->session->userdata('project');

        // echo "aaaaaaaaaaaaaaaaaa: " .$currentProject;
        // list all projects
        $projects = $this->project->getProject();
        $projectIds = [];

        if(!isset($currentProject)){
            $projectIds = array_column($projects,'id');
            // $projectNames = array_column($projects,'name');
        } else {
            $projectIds = $this->session->userdata('project');
        }

        if(!$projectIds){
            $projectIds = array_column($projects,'id');
            // $projectNames = array_column($projects,'name');
        }
        // var_dump($currentProject);
        // die();

        //query all reports
        $data = array(
//            'startDate' => $this->get('startdate'),
//            'endDate' => $this->get('enddate'),
            'project' => $projectIds,
        );
        $reports = $this->report->getReports($data, ['key'=>'startTime', 'sortType' => 'desc']);

        $reportIds = [];

        foreach ($reports as $report) {
            $reportIds []= $report['id'];

            if ($report['parentLength']>0){
                $parentCount += $report['parentLength'];
                if($report['passParentLength']>0) {
                    $parentPassed += $report['passParentLength'];
                }
                if($report['failParentLength']>0) {
                    $parentFailed += $report['failParentLength'];
                }
                if($report['errorParentLength']>0) {
                    $parentErrored += $report['errorParentLength'];
                }
                if($report['childLength']>0) {
                    $childCount += $report['childLength'];
                }
                if($report['passChildLength']>0) {
                    $childPassed += $report['passChildLength'];
                }
                if($report['failChildLength']>0) {
                    $childFailed += $report['failChildLength'];
                }
                if($report['errorChildLength']>0) {
                    $childErrored += $report['errorChildLength'];
                }
            }
        }

        // list all categories
        $categories = $this->category->getNames();

        $topPassed = $this->test->getGroupsWithCounts(
            array("status" => "pass","report" => $reportIds),
            array("status","name"),
            array("key" => "count","sortType" => "desc"),
            "10");

        $topFailed = $this->test->getGroupsWithCounts(
            array("status" => ["fail","fatal"],"report" => $reportIds),
            array("status","name"),
            array("key" => "count","sortType" => "DESC"),
            "10");
                
        $view = array(
            "projects"=> $projects,
            "currentProject"=> $this->session->userdata('projectName'),
            "reports"=> $reports,
            "categories"=> $categories,
            "trendDataPoints"=> $settings['trendDataPoints'],
            "trendDataPointFormat"=> $settings['trendDataPointFormat'],
            "token" => array(
                "csrf"=> $this->session->userdata('csrfSecret')
            ),
            "trends" => array(
                "topPassed"=> $topPassed,
                "topFailed"=> $topFailed
            ),
            "aggregates" => array(
                "parentCount"=> $parentCount,
                "parentPassed"=> $parentPassed,
                "parentFailed"=> $parentFailed,
                "parentErrored"=> $parentErrored,
                "childCount"=> $childCount,
                "childPassed"=> $childPassed,
                "childFailed"=> $childFailed,
                "childErrored"=> $childErrored
            )
        );

        if($authen)
        {
            $this->response($view, 200); // 200 being the HTTP response code
        }else{
            $this->response(array("error" => "You do not has permission"), 404);
        }
    }

    function isLoggedIn_get(){
        $authen = $this->session->userdata('authenticated');
        $user = $this->session->userdata('user');

        if($authen){
            $this->response(array("user" => $user, "isLoggedIn" => $authen), 200);
        } else {
            $this->response(array("isLoggedIn" => $authen), 401);
        }
    }

    function logout_get(){
        $this->session->set_userdata('csrfSecret', '');
        $this->session->sess_destroy();
        $this->response("OK", 200);
    }
}
