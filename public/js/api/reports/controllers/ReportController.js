angular.module('ExtentX')
    .controller('ReportController', ['$rootScope', '$scope', '$http',
        function ($rootScope, $scope, $http) {
            $scope.padded = $rootScope.sideNavToggled ? 'padded' : '';
            $scope.test = 'label label-primary';
            $scope.endDate = new Date();
            $scope.startDate = new Date($scope.endDate.getFullYear(), $scope.endDate.getMonth(), $scope.endDate.getDate() - 7);
            $scope.startDatePicker = {opened: false};
            $scope.endDatePicker = {opened: false};
            /* pagination */
            $scope.currentPage = 0;
            $scope.pageSize = 20;
            $scope.gap = 3;

            // aaaaaaaaaaaaaaaaaaa
            $scope.getNumberOfPages = function (len) {
                if (typeof len === 'undefined' || len === 0) return 0;
                return Math.ceil(len / $scope.pageSize);
            }

            $scope.range = function (size, start, end) {
                var ret = [];
                console.log(size, start, end);

                if (size < end) {
                    end = size;
                    start = size - $scope.gap;
                }
                for (var i = start; i < end; i++) {
                    ret.push(i);
                }
                console.log(ret);
                return ret;
            };

            $scope.prevPage = function () {
                if ($scope.currentPage > 0) {
                    $scope.currentPage--;
                }
            };

            $scope.nextPage = function (size) {
                if ($scope.currentPage < size - 1) {
                    $scope.currentPage++;
                }
            };

            $scope.setPage = function () {
                $scope.currentPage = this.n;
            };

            $scope.pagination = {
                maxSize: 3,
                bigTotalItems: 22,
                bigCurrentPage: 1,
                itemsPerPage: 10
            };
            // aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa


            $scope.openStartDate = function () {
                $scope.startDatePicker.opened = true;
            };
            $scope.openEndDate = function () {
                $scope.endDatePicker.opened = true;
            };

            $scope.update = function (projectName) {
                console.log(projectName);
                window.alert(projectName);
            }

            $scope.Reset = function (query) {
                $scope.endDate = new Date();
                $scope.startDate = new Date($scope.endDate.getFullYear(), $scope.endDate.getMonth(), $scope.endDate.getDate() - 7);

                $scope.Aggregates();
            }

            $scope.Aggregates = function (query) {
                var req = {
                    method: 'GET',
                    url: '/aggregates',
                    params: {
                        startdate: $scope.startDate * 1,
                        enddate: $scope.endDate * 1,
                    }
                };

                console.log(req);

                $http.defaults.headers.post['X-CSRF-Token'] = $rootScope._csrf;

                $http(req).success(function (response) {
                    $scope.res = response;
                    $scope.max = response.trendDataPoints;

                    $scope.hasStandard = false;
                    $scope.hasBDD = false;

                    if (response != "") {
                        for (var ix = 0; ix < response.reports.length; ix++) {
                            var report = response.reports[ix];
                            if (report.grandChildLength === 0) {
                                $scope.hasStandard = true;
                            } else {
                                $scope.hasBDD = true;
                            }
                        }
                    }

                    $scope.$broadcast('MyAggregatesTest', {
                        responseData: angular.copy(response)
                    });
                    $scope.$broadcast('MyAggregatesLog', {
                        responseData: angular.copy(response)
                    });
                }).error(function (response) {
                    console.log(response);
                });
            };

            $scope.Aggregates();
        }]);