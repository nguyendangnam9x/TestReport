angular.module('ExtentX').
    controller('TestAnalysisController', ['$scope', 'Aggregates', 'PieChartSettings', function($scope, Aggregates, PieChartSettings) {
        Aggregates.then(function(response) {
            var testDistribution = response.testDistribution;
            $scope.max = response.trendDataPoints > response.reports.length ? response.reports.length : response.trendDataPoints;

            $scope.pass = 0, $scope.fail = 0, $scope.fatal = 0, $scope.error = 0, $scope.warning = 0, $scope.skip = 0, $scope.unknown = 0;
            
            for (var ix = 0; ix < $scope.max; ix++) {
                var report = response.reports[ix];

                if(parseInt(report.passParentLength)>0) {
                    $scope.pass += parseInt(report.passParentLength);
                }
                if(parseInt(report.failParentLength)>0) {
                    $scope.fail += parseInt(report.failParentLength);
                }
                if(parseInt(report.fatalParentLength)>0) {
                    $scope.fatal += parseInt(report.fatalParentLength);
                }
                if(parseInt(report.errorParentLength)>0) {
                    $scope.error += parseInt(report.errorParentLength);
                }
                if(parseInt(report.warningParentLength)>0) {
                    $scope.warning += parseInt(report.warningParentLength);
                }
                if(parseInt(report.skipParentLength)>0) {
                    $scope.skip += parseInt(report.skipParentLength);
                }
                if(parseInt(report.unknownParentLength)>0) {
                    $scope.unknown += parseInt(report.unknownParentLength);
                }

                // console.log($scope.fatal);
            }
            
            $scope.labels = [ 'Pass', 'Fail', 'Fatal', 'Error', 'Warning', 'Skip', 'Unknown' ];
            $scope.data = [ $scope.pass, $scope.fail, $scope.fatal, $scope.error, $scope.warning, $scope.skip, $scope.unknown ];
            $scope.options = PieChartSettings.options;
            $scope.colors = PieChartSettings.colors;
        });
    }]);
