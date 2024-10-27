var app = angular.module("gesfut", []);

app.controller("QuadrasCtrl", function($scope){

    $scope.myModel = 1;

    $scope.myOptions = [
      {id: 1, title: 'Spectrometer'},
      {id: 2, title: 'Star Chart'},
      {id: 3, title: 'Laser Pointer'}
    ];
    
    $scope.myConfig = {
      create: true,
      valueField: 'id',
      labelField: 'title',
      delimiter: '|',
      placeholder: 'Pick something',
      onInitialize: function(selectize){
        // receives the selectize object as an argument
      },
      // maxItems: 1
    };
});
