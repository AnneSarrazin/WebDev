
var app = angular.module("modalFormApp", ['ui.bootstrap']);

app.controller("modalAccountFormController", ['$scope', '$modal', '$log',

    function ($scope, $modal, $log) {
        
        $scope.user =  {
            
            email : '',
            nom : '',
            prenom: '',
            date:''
            
        };
         
       
         
        
        $scope.showForm = function () {
            $scope.message = "Show Form Button Clicked";
            console.log($scope.message);

            var modalInstance = $modal.open({
                templateUrl: 'login.html',
                controller: 'ModalInstanceCtrl',
                scope: $scope,
                resolve: {
                    user: function () {
                        return $scope.user;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                $scope.selected = selectedItem;
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };
            }]); 
  
app.controller('ModalInstanceCtrl',function($scope,$modalInstance,user,$http){
    
    $scope.user = user;
    $scope.submitForm = function(){
      
           console.log('user form is in scope');
           console.log(user);
           
           $http({
                method  : 'POST',
                url     : '../demos/php/action.php',
                data    : $.param($scope.user),  //param method from jQuery
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function(data){
                
                if (data.success) { //success comes from the return json object
                   
                    $scope.resultMessage = data.message;
                    $scope.result='bg-success';
                    
                } else {
                    
                    $scope.resultMessage = data.message;
                    $scope.result='bg-danger';
                }
            });
           
           //$modalInstance.close('closed');
          
       
   };
   
    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
       
});





