//var app = angular.module('mainApp', ['mainRoutes', 'cricketService', 'ngAnimate', 'toastr', 'ui.bootstrap', 'ngRoute']);
 
app.controller('scoresController', ['$scope', '$routeParams', '$http', 'toastr', 'CricketService','$interval', function($scope, $routeParams, $http, toastr, CricketService, $interval) {
    
    $scope.match_id = $routeParams.id;
    $scope.getScore = function (id) {
        CricketService.getScore(id).success(function (data){
            $scope.score = data;
            $scope.first_inning_batting = data[0].first_inning[0].batting_team_1;
            $scope.first_inning_bowling = data[0].first_inning[1].bowling_team_2;
            $scope.second_inning_batting = data[1].second_inning[0].batting_team_2;
            $scope.second_inning_bowling = data[1].second_inning[1].bowling_team_1;
        }).error(function () {
            toastr.error('Something went off. Please try again', 'Fail');
        })
    };
    var scores = $interval(function (){
        $scope.getScore($routeParams.id);
    },5000);
}]);