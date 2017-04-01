 var mainApp=angular.module('mainApp', []);
 mainApp.controller("signUpCtrl",function ($scope,$http) {
 	// body...
 	$scope.firstName="";
 	$scope.lastName="";
 	$scope.userName="";
 	$scope.password="";
 	$scope.signUp=function()
 	{
 		//alert("sign Up");
 		if($scope.firstName!=""&&$scope.lastName!=""&&$scope.userName!=""&&$scope.password!="")
 		{
 			$http.post("bin/signUp.php",{firstName:$scope.firstName,
 										lastName:$scope.lastName,
 										password:$scope.password,
 										userName:$scope.userName
 										}).success(function(data,status){
 										Data=angular.fromJson(data);
 										if(Data.signupstatus==1)
 											alert("User Created Successfully");
 										else if(Data.signupstatus==3)
 											alert("User Already Exist");
 										else if(Data.signupstatus==3)
 											alert("Error in creating user"); 


 			});
 		}
 	}
 	
 });