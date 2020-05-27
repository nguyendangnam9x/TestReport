angular.module('ExtentX', ['ngRoute', 'ngCookies', 'chart.js', 'ui.bootstrap']).
    config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
        $routeProvider.
            when('/', { templateUrl: 'public/partials/analysis.html' }).
            when('/admin', { templateUrl: 'public/partials/admin.html' }).
            when('/analysis', { templateUrl: 'public/partials/analysis.html' }).
            when('/reports', { templateUrl: 'public/partials/reports.html' }).
            when('/reportDetails', { templateUrl: 'public/partials/details.html' }).
            when('/categories', { templateUrl: 'public/partials/category.html' }).
            when('/settings', { templateUrl: 'public/partials/settings.html' }).
            when('/search', { templateUrl: 'public/partials/search.html' }).
            when('/testcase', { templateUrl: 'public/partials/testcase.html' }).
            when('/testplan', { templateUrl: 'public/partials/testplan.html' }).
            otherwise({ redirectTo: '/' });
    }]);
