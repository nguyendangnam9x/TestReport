<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $projectTitle;?></title>

    <!-- Viewport mobile tag for sensible mobile support -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- csrf token -->
    <meta name="csrf-token" content="<?php echo $csrfToken; ?>">
    
    <!--STYLES-->
    <link rel="stylesheet" href="/public/styles/dependencies/bootstrap-lumen-3.3.6.min.css">
    <link rel="stylesheet" href="/public/styles/dependencies/fontawesome-4.5.0.min.css">
    <link rel="stylesheet" href="/public/styles/extentx.css">
    <link rel="stylesheet" href="/public/styles/importer.css">
    <!--STYLES END-->
  </head>

  <body ng-app='ExtentX' class='<?php echo $theme; ?>'>
    <?php $this->load->view('header');?>
        
    <?php if($this->session->userdata('authenticated')) echo "<div ng-view></div>"; else $this->load->view('signin');?>

    <!--SCRIPTS-->
    <!-- <script src="/public/js/dependencies/sails.io.js"></script> -->
    <script src="/public/js/dependencies/angular-1.5.3.min.js"></script>
    <script src="/public/js/dependencies/chart-1.0.1.min.js"></script>
    <script src="/public/js/dependencies/angular-bootstrap-1.2.5.min.js"></script>
    <script src="/public/js/dependencies/angular-charts-0.9.0.min.js"></script>
    <script src="/public/js/dependencies/angular-cookies-1.5.3.min.js"></script>
    <script src="/public/js/dependencies/angular-route-1.5.2.min.js"></script>
    <script src="/public/js/dependencies/jquery-1.12.2-min.js"></script>

    <script src="/public/js/api/ExtentX.js"></script>
    <script src="/public/js/api/common/services/RouteQuery.js"></script>
    <script src="/public/js/api/common/services/Aggregates.js"></script>
    <script src="/public/js/api/common/services/CSRFToken.js"></script>
    <script src="/public/js/api/common/services/DateTime.js"></script>
    <script src="/public/js/api/common/services/Icon.js"></script>
    <script src="/public/js/api/common/services/LineChartSettings.js"></script>
    <script src="/public/js/api/common/services/PieChartSettings.js"></script>
    <script src="/public/js/api/admin/controllers/AdminController.js"></script>
    <script src="/public/js/api/analysis/controllers/DataPointsController.js"></script>
    <script src="/public/js/api/analysis/controllers/TestAnalysisController.js"></script>
    <script src="/public/js/api/analysis/services/DataPointFormat.js"></script>
    <script src="/public/js/api/authentication/controllers/SigninController.js"></script>
    <script src="/public/js/api/authentication/controllers/SignoutController.js"></script>
    <script src="/public/js/api/authentication/controllers/UserController.js"></script>
    <script src="/public/js/api/categories/controllers/CategoryViewController.js"></script>
    <script src="/public/js/api/categories/directives/categoryFormats.js"></script>
    <script src="/public/js/api/common/controllers/LogTrendsController.js"></script>
    <script src="/public/js/api/common/controllers/ModalInstanceController.js"></script>
    <script src="/public/js/api/common/controllers/ProjectController.js"></script>
    <script src="/public/js/api/common/controllers/TestTrendsController.js"></script>
    <script src="/public/js/api/common/directives/startFrom.js"></script>
    <script src="/public/js/api/navigation/controllers/NavigationController.js"></script>
    <script src="/public/js/api/navigation/directives/navigationState.js"></script>
    <script src="/public/js/api/reports/controllers/ReportController.js"></script>
    <script src="/public/js/api/search/controllers/SearchController.js"></script>
    <script src="/public/js/api/search/directives/searchInit.js"></script>
    <script src="/public/js/api/tests/controllers/HistoryController.js"></script>
    <script src="/public/js/api/tests/controllers/NodeController.js"></script>
    <script src="/public/js/api/tests/controllers/TestDetailsController.js"></script>
    <script src="/public/js/api/tests/directives/testDetailsViewer.js"></script>

    <script src="/public/js/api/analysis/services/CustomDataChart.js"></script>
    <!--SCRIPTS END-->
  </body>
</html>
