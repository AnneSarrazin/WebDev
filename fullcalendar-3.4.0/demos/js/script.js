// Code goes here
    angular.module('modalApp', ['modal-form']);
  run(['$rootScope', '$window', 'formService', function($rootScope, $window, formService) {
    $rootScope.user = {
      email: "test@google.com",
      id: "test123456"
    };
    
    $rootScope.init = function() {
      $window.location.reload();
    };
    
    // open modal form dynamically
    $rootScope.open = formService({
      data: $rootScope.user,
      templateUrl: 'login.html',
      method: 'POST',
      callback: $rootScope.init,
      path: '/authenticate',
      dialogClass: 'small',
      closeOnSuccess: true
    });
  }]);
 
 
 
 
 
 
 
  


