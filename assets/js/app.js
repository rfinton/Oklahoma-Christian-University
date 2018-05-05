(function() {
  angular.module('ocu', [])
  .controller('css', ['$scope', '$window', function($scope, $window) {
    $window.onresize = $window.onload = function() {
      $('.container-fluid').css('min-height', $window.innerHeight + 'px');
    };
  }]);
})();