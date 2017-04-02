var mainApp=angular.module('mainApp', []);
 mainApp.controller("flightTrackingCtrl",function ($scope,$http) {
 	// body...
 	
 /*	$http.post("bin/check.php").success(function(data,status){
 		Data=angular.fromJson(data);
 		if(Data.loginstatus==1)
 			window.location.href="employeesRegistration.html";
 	});*/
 	 //$scope.airportList=["LXI","LKO"];
 	 $http.get("bin/airport_list.php"). 
		success(function(data,status)
		{
			//alert(data);
			$scope.airportList=angular.fromJson(data);
		});
	 $scope.getFlights=function()
	 {
	 	$http.get("bin/airport_list.php"). 
		success(function(data,status)
		{
			//alert(data);
			$scope.airportList=angular.fromJson(data);
		});
	 }

	 $scope.getFlightStatus=function()
	 {



	 }
 	
 });