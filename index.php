<?php

session_start();

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Flight Centre - Travel Group</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
  <style>
    body, h1, a, label{
    font-family: 'Lato', sans-serif;
   
}
  .form_style
  {
   width: 600px;
   margin: 0 auto;
  }
  
  </style>
 </head>
 <body>
  <div class="col-xs-6 col-md-6 col-sm-6" style="background-color: #CC0C00;"><img src="./img/airplane.svg"></div>
    <div class="col-xs-6 col-md-6 col-sm-6">
  <br />
   <h3 align="center"><img src="./img/logo.png" align="center"></h3>

  <br />

  <div ng-app="login_app" ng-controller="login_controller" class="container form_style">
   <?php
   if(!isset($_SESSION['user_name']))
   {
   ?>
   <div class="alert {{alertClass}} alert-dismissible" ng-show="alertMsg">
    <a href="#" class="close" ng-click="closeMsg()" aria-label="close">&times;</a>
    {{alertMessage}}
   </div>

   <div class="panel panel-default" ng-show="login_form">
    <div class="panel-heading">
     <h3 class="panel-title">Sign In</h3>
    </div>
    <div class="panel-body">
     <form method="post" ng-submit="submitLogin()">
      <div class="form-group">
       <label>Username</label>
       <input type="text" name="username" ng-model="loginData.username" class="form-control" />
      </div>
      <div class="form-group">
       <label>Password</label>
       <input type="password" name="password" ng-model="loginData.password" class="form-control" />
      </div>
      <div class="form-group" align="left">
        <input type="button" name="forget_link" class="btn btn-primary btn-link"  value="Forgot Password?" />
        <br />
       <input type="submit" name="login" class="btn btn-primary" value="Submit" />
       
       
      </div>
     </form>
    </div>
   </div>

</div>
   <?php
   }
   else
   {
   ?>
   <div class="panel panel-default">
    <div class="panel-body">
     <h1>Welcome - <?php echo $_SESSION['user_name'];?></h1>
     <a href="logout.php">Logout</a>
    </div>
   </div>
   <?php
   }
   ?>

  </div>

 </body>
</html>

<script>
var app = angular.module('login_app', []);
app.controller('login_controller', function($scope, $http){
 $scope.closeMsg = function(){
  $scope.alertMsg = false;
 };

 $scope.login_form = true;

 $scope.showLogin = function(){
  $scope.register_form = false;
  $scope.login_form = true;
  $scope.alertMsg = false;
 };

 $scope.submitLogin = function(){
  $http({
   method:"POST",
   url:"login.php",
   data:$scope.loginData
  }).success(function(data){
   if(data.error == 'false')
   {
    $scope.alertMsg = true;
    $scope.alertClass = 'alert-danger';
    $scope.alertMessage = data.message;
   }
   else
   {
    // $scope.alertMsg = true;
    // $scope.alertClass = 'alert-danger';
    // $scope.alertMessage = data.message;
    location.reload();
   }
  });
 };

});
</script>
