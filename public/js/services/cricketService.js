var app = angular.module('cricketService', []);
 
app.factory('CricketService', ['$http', function($http) {
 var api_v1 = 'api/v1/';
 return {
 	fetchMatches: function (){
 		return $http.get(api_v1+'cricket/matches');
 	},
 	getScore: function (id){
 		return $http.post(api_v1+'cricket/get-score',{'id':id});
 	},
 	updateMatch: function (ballEvent){
		return $http.post(api_v1+'cricket/update-records', ballEvent);
 	},
	 add: function (todoName) {
		 var model = {
		   TodoName: todoName
		 }
	   return $http.post(api_v1+'todos', model);
	 },
	 getAllCompletedTodos: function() {
	    return $http.get(api_v1+'todos/completed');
	 },
	 getActiveTodos: function () {
	    return $http.get(api_v1+'todos/active');
	 },
	 get: function () {
	   return $http.get(api_v1+'todos');
	 },
	 update: function(id, isDone, todoName) {
		 var model = {
		   TodoName: todoName,
		   IsDone: isDone
		 }
	 return $http.put(api_v1+'todos/'+id, model);
	 }
 };
}]);