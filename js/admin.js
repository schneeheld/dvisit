(function() {
	var app = angular.module('dVisit', []);
	app.controller('adminCtrl', function($scope, $http) {
		$http.get("api/getRecords.php").then(function(response) {
			$scope.names = response.data.records;
		});
	});
})();
