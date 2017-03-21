// JS code
(function() {

	var app = angular.module('dVisit', [ 'ui.bootstrap' ]);

	app.controller('FormController', [ '$http', '$scope',	function($http, $scope) {

				var type = this;
				type.reasons = [];
				
				// Get visit reasons
				$http.get('reasons-visit.json').success(function(data) {
					type.reasons = data;
				});

				$scope.booking = {};
				
				// Form submit PHP action
				$scope.url = 'addRecord.php';

				$scope.handleFormSubmit = function(booking) {

				// Call PHP action
				$http.post($scope.url, {
					"userName" : $scope.booking.userName,
					"visitReason" : $scope.booking.visitReason,
					"startDate" : $scope.booking.startDate,
					"visitTime" : $scope.booking.visitTime,
					"endDate" : $scope.booking.endDate,
					}).success(function(data, status) {
						$scope.booking = {};
						$scope.status = status;
						$scope.data = data;
						$scope.result = data;
						$scope.$parent.result = data;
						// display success message
						$scope.$parent.message = true;
					})
					.error(function () {
						$window.alert("Error retrieving data from server.");
					})
				};

				var me = this;

				// Datepicker
				$scope.open = function($event) {
					$event.preventDefault();
					$event.stopPropagation();

					$scope.opened1 = true;
					$scope.opened2 = false;
				};

				$scope.open2 = function($event) {
					$event.preventDefault();
					$event.stopPropagation();

					$scope.opened1 = false;
					$scope.opened2 = true;
				};

				$scope.clear = function() {
					$scope.dt = null;
					$scope.dt2 = null;
				};

				$scope.toggleMin = function() {
					$scope.minDate = $scope.minDate ? null : new Date();
				};
				$scope.toggleMin();

				$scope.dateOptions = {
					formatYear : 'yy',
					startingDay : 1
				};

				// Datepicker format
				$scope.dateFormat = 'yyyy-MM-dd';

			} ]);

	app.controller('PanelController', function() {
		this.tab = 1;

		this.selectTab = function(setTab) {
			this.tab = setTab;
			if (setTab === 2) {
				//$scope.message = false;
			}
		};

		this.isSelected = function(checkTab) {
			return this.tab == checkTab;

		};
	});
})();
