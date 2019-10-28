var app = angular.module('mainApp', ['mainRoutes', 'cricketService', 'ngAnimate', 'toastr', 'ui.bootstrap', 'ngRoute']);
 
app.controller('mainController', ['$scope', '$http', 'toastr', 'CricketService', '$interval', function($scope, $http, toastr, CricketService , $interval) {
    /*$scope.lists = [];
    $scope.completedTodos = [];
    $scope.allTodos = [];
 
    var initializeTodos = function() {
        CricketService.getActiveTodos().success(function (data) {
            $scope.lists = data;
            $scope.anyActiveTodos = $scope.lists.length;
            console.log($scope.lists);
        });
        CricketService.get().success(function (data) {
            $scope.allTodos = data;
        });
        CricketService.getAllCompletedTodos().success(function (data) {
            $scope.completedTodos = data;
            console.log('completed todos');
            console.log($scope.completedTodos);
        });
    }
 
    initializeTodos();
 
    $scope.addTodos = function () {
        var input = $scope.myinput;
 
        CricketService.add(input).success(function (data) {
            $scope.myinput = '';;
            toastr.success('Successfully added!', 'Success');
            $scope.anyActiveTodos = true;
 
            initializeTodos();
            $scope.lists.push({
                id: data.id,
                TodoName: input,
                IsDone: false
            });
        }).error(function () {
            toastr.error('Something went off. Please try again', 'Fail');
        });
    }
    $scope.done = function (list) {
        console.log('task done!');
        console.log(list);
 
        if (list.IsDone) {
            var todoIndex = $scope.lists.indexOf(list);
 
            CricketService.update(list.id, list.IsDone, list.TodoName).success(function() {
                $scope.anyActiveTodos = $scope.lists.length;
 
                initializeTodos();
                toastr.success('Done a task!', 'Success');
            });
 
            //todo: logic here...
        }
    }*/
    $scope.getMatches = function () {
        CricketService.fetchMatches().success(function (data){
            $scope.matches = data;
        }).error(function () {
            toastr.error('Something went off. Please try again', 'Fail');
        })
    }
    function randomScroes(){
        var rand = ~~(Math.random() * 10) + 0;
        var scrObj   = {};
        scrObj.event = rand;
        return scrObj;
    }
    var match_1_ball_count = match_2_ball_count = match_3_ball_count = match_4_ball_count =0;


    var updateMatch1 = $interval(function (){
        var ballEvent = randomScroes();
        ballEvent.match_id = 1;
        match_1_ball_count++;
        if(match_1_ball_count%6){
            ballEvent.change_bowler=true;
        }else{
            ballEvent.change_bowler=false;
        }
        if(match_1_ball_count==120){
            ballEvent.change_inning=true;
        }else{
            ballEvent.change_inning=false;
        }
        CricketService.updateMatch(ballEvent).success(function (data){
            $scope.matchOneScore = data;
        }).error(function () {
            toastr.error('Something went off. Please try again', 'Fail');
        })
    },5000);
    var updateMatch2 = $interval(function (){
        var ballEvent = randomScroes();
        ballEvent.match_id = 2;
        match_2_ball_count++;
        if(match_2_ball_count%6){
            ballEvent.change_bowler=true;
        }else{
            ballEvent.change_bowler=false;
        }
        if(match_2_ball_count==120){
            ballEvent.change_inning=true;
        }else{
            ballEvent.change_inning=false;
        }
        CricketService.updateMatch(ballEvent).success(function (data){
            $scope.matchTwoScore = data;
        }).error(function () {
            toastr.error('Something went off. Please try again', 'Fail');
        })
    },8000);
    var updateMatch3 = $interval(function (){
        var ballEvent = randomScroes();
        ballEvent.match_id = 3;
        match_3_ball_count++;
        if(match_3_ball_count%6){
            ballEvent.change_bowler=true;
        }else{
            ballEvent.change_bowler=false;
        }
        if(match_3_ball_count==120){
            ballEvent.change_inning=true;
        }else{
            ballEvent.change_inning=false;
        }
        CricketService.updateMatch(ballEvent).success(function (data){
            $scope.matchThreeScore = data;
        }).error(function () {
            toastr.error('Something went off. Please try again', 'Fail');
        })
    },11000);
    var updateMatch4 = $interval(function (){
        var ballEvent = randomScroes();
        ballEvent.match_id = 4;
        match_4_ball_count++;
        if(match_4_ball_count%6){
            ballEvent.change_bowler=true;
        }else{
            ballEvent.change_bowler=false;
        }
        if(match_4_ball_count==120){
            ballEvent.change_inning=true;
        }else{
            ballEvent.change_inning=false;
        }
        CricketService.updateMatch(ballEvent).success(function (data){
            $scope.matchFourScore = data;
        }).error(function () {
            toastr.error('Something went off. Please try again', 'Fail');
        })
    },14000);
    /*$interval.cancel(updateMatch1);
    $interval.cancel(updateMatch2);
    $interval.cancel(updateMatch3);
    $interval.cancel(updateMatch4);*/
    

}]);