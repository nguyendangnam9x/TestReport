angular.module('ExtentX').
    controller('LogTrendsController', ['$scope', 'Aggregates', 'DateTime', 'LineChartSettings', 'DataPointFormat', 'CustomDataChart',
      function($scope, Aggregates, DateTime, LineChartSettings, DataPointFormat, CustomDataChart) {
        Aggregates.then(function(response) {
            var dataPoints = response.trendDataPoints;
            var dataPointFormat = response.trendDataPointFormat;
            
            var labels = [];
            var passed = [], failed = [], others = [];

            response.reports = CustomDataChart.getDataCustomChart(response.reports, dataPoints);

            var length = response.reports.length > dataPoints ? dataPoints : response.reports.length;

            $scope.passStep = 0, $scope.failStep = 0, $scope.fatalStep = 0, $scope.errorStep = 0, $scope.warningStep = 0, $scope.skipStep = 0, $scope.unknownStep = 0, $scope.infoStep = 0;
            for (var ix = length - 1; ix >= 0; ix--) {
                var report = response.reports[ix];

                labels.push(DataPointFormat.getDataPointFormat(dataPointFormat, report, ix));

                if(parseInt(report.passChildLength)>0) {
                    $scope.passStep = parseInt(report.passChildLength);
                } else {
                    $scope.passStep = 0;
                }
                if(parseInt(report.failChildLength)>0) {
                    $scope.failStep = parseInt(report.failChildLength);
                } else {
                    $scope.failStep = 0;
                }
                if(parseInt(report.fatalChildLength)>0) {
                    $scope.fatalStep = parseInt(report.fatalChildLength);
                } else {
                    $scope.fatalStep = 0;
                }
                if(parseInt(report.errorChildLength)>0) {
                    $scope.errorStep = parseInt(report.errorChildLength);
                } else {
                    $scope.errorStep = 0;
                }
                if(parseInt(report.warningChildLength)>0) {
                    $scope.warningStep = parseInt(report.warningChildLength);
                } else {
                    $scope.warningStep = 0;
                }
                if(parseInt(report.skipChildLength)>0) {
                    $scope.skipStep = parseInt(report.skipChildLength);
                } else {
                    $scope.skipStep = 0;
                }
                if(parseInt(report.infoChildLength)>0) {
                    $scope.infoStep = parseInt(report.infoChildLength);
                } else {
                    $scope.infoStep = 0;
                }
                if(parseInt(report.unknownChildLength)>0) {
                    $scope.unknownStep = parseInt(report.unknownChildLength);
                } else {
                    $scope.unknownStep = 0;
                }
                passed.push($scope.passStep);
                failed.push($scope.failStep + $scope.errorStep);
                others.push($scope.fatalStep + $scope.warningStep + $scope.skipStep + $scope.infoStep + $scope.unknownStep);
            }
            
            $scope.labels = labels;
            $scope.data = [ passed, failed, others ];
            $scope.colors = LineChartSettings.colors;
            $scope.options = LineChartSettings.options;

            console.log($scope);
        });
    }]);