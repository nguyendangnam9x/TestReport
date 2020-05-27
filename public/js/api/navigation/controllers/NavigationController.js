angular.module("ExtentX")
    .controller("NavigationController", ["$scope", "$rootScope", "$http", "$window", function($scope, $rootScope, $http, $window) {
        $scope.states = {};
        $scope.states.activeItem = 'item1';
        
        $scope.items = [{
            id: "item1",
            target: "#/",
            title: "Analysis",
            icon: "fa-th-large"
        }, {
            id: "item2",
            target: "#/reports",
            title: "Reports",
            icon: "fa-folder-o"
        }, {
            id: "item3",
            target: "#/search",
            title: "Search",
            icon: "fa-search"
        /*}, {
            id: "item3",
            target: "#/categories",
            title: "Categories",
            icon: "fa-tag"
        }, {
            id: "item4",
            target: "#/search",
            title: "Search",
            icon: "fa-search"
        }, {
            id: "item5",
            target: "#/testcase",
            title: "Testcase",
            icon: "fa-sitemap"
        }, {
            id: "item6",
            target: "#/testplan",
            title: "Test Plan",
            icon: "fa-list"*/
        }];

        $scope.setTheme = function(theme) {
            var req = {
                method: 'POST',
                url: '/themeSetting',
                data: {
                    theme: theme
                }
            };

            $http.defaults.headers.post['X-CSRF-Token'] = $rootScope._csrf;

            $http(req).
                success(function(response) {
                    $window.location.reload();
                }).
                error(function(response) {
                    console.log(response);
                });
        };

    }]);
