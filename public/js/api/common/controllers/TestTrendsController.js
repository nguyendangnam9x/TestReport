angular.module('ExtentX').
    controller('TestTrendsController', ['$scope', 'Aggregates', 'DateTime', 'LineChartSettings', 'DataPointFormat', 'CustomDataChart',
      function($scope, Aggregates, DateTime, LineChartSettings, DataPointFormat, CustomDataChart) {
        Aggregates.then(function(response) {
            var dataPoints = response.trendDataPoints;
            var dataPointFormat = response.trendDataPointFormat;
            
            var labels = [];
            var passed = [], failed = [], others = [];

            response.reports = CustomDataChart.getDataCustomChart(response.reports, dataPoints);

            var length = response.reports.length > dataPoints ? dataPoints : response.reports.length;

            $scope.pass = 0, $scope.fail = 0, $scope.fatal = 0, $scope.error = 0, $scope.warning = 0, $scope.skip = 0, $scope.unknown = 0;
            for (var ix = length - 1; ix >= 0; ix--) {
                var report = response.reports[ix];
                labels.push(DataPointFormat.getDataPointFormat(dataPointFormat, report, ix));

                if(parseInt(report.passParentLength)>0) {
                    $scope.pass = parseInt(report.passParentLength);
                } else {
                    $scope.pass = 0;
                }
                if(parseInt(report.failParentLength)>0) {
                    $scope.fail = parseInt(report.failParentLength);
                } else {
                    $scope.fail = 0;
                }
                if(parseInt(report.fatalParentLength)>0) {
                    $scope.fatal = parseInt(report.fatalParentLength);
                } else {
                    $scope.fatal = 0;
                }
                if(parseInt(report.errorParentLength)>0) {
                    $scope.error = parseInt(report.errorParentLength);
                } else {
                    $scope.error = 0;
                }
                if(parseInt(report.warningParentLength)>0) {
                    $scope.warning = parseInt(report.warningParentLength);
                } else {
                    $scope.warning = 0;
                }
                if(parseInt(report.skipParentLength)>0) {
                    $scope.skip = parseInt(report.skipParentLength);
                } else {
                    $scope.skip = 0;
                }
                if(parseInt(report.unknownParentLength)>0) {
                    $scope.unknown = parseInt(report.unknownParentLength);
                } else {
                    $scope.unknown = 0;
                }
                passed.push($scope.pass);
                failed.push($scope.fail + $scope.error);
                others.push($scope.fatal + $scope.warning + $scope.skip + $scope.unknown);
                // console.log('aaaaaaaaaaa: ' +$scope.pass+ '|' +$scope.fail+ '|' +$scope.fatal+ '|' +$scope.error+ '|' +$scope.warning+ '|' +$scope.skip+ '|' +$scope.unknown);
            }
            
            $scope.labels = labels;
            $scope.data = [ passed, failed, others ];
            $scope.colors = LineChartSettings.colors;
            $scope.options = LineChartSettings.options;

            console.log($scope);
        });
    }]);
