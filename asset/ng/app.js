PATH = window.location.protocol + "//" + window.location.host + "/offerapp/";
var App1 = angular.module("App1",['ui.bootstrap']);
var copyright = '';
//$('body').append(copyright);
//country controller for country view and country php controller
    App1.controller('gridController', function ($scope, $http, $timeout){
        $("#loaderkender").show();
        $http.get(PATH+'admin/memberListLoad').success(function(data, status){
            $scope.list = data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 10; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter  
            $scope.totalItems = $scope.list.length;
            $("#loaderkender").hide();
        });
        
        $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
        };
        $scope.filter = function() {
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
        };
        $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
        };
        
        if(typeof copyright === 'undefined'){
            alert('Please use licensed version');
            window.close();
            window.location.reload();
        };
    });
    
    App1.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    };
});
