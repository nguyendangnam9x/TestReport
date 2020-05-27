angular.module('ExtentX').
    factory('Auth', ['$http', '$q', 'RouteQuery', function($http, $q, routeQuery) {
        return routeQuery.get('/isLoggedIn');
    }]);