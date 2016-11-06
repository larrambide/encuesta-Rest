var main = angular.module("main",[]);

main.directive('a',function(){
	return {
		restrict: 'E',
		link: function(scope, elem, attrs){
			if(attrs.ngClick || attrs.href === '' || attrs.href === '#'){
				elem.on('click', function(e){
					e.preventDefault();
				});
			}
		}
	};
});

main.controller('encuesta',['$scope','$http',function($scope,$http){
	$scope.ask = 1;
	$scope.yet_fill = 0;
	$scope.results = {};

	$scope.select_answer = function(num){
		$scope.results[$scope.ask] = num;
		$scope.yet_fill = $scope.ask;
		$scope.ask++;
		if($scope.ask == 7){
			$scope.send_results();
		}
	};

	$scope.go_before = function(){
		$scope.ask = ($scope.ask > 1)? --$scope.ask : $scope.ask;
	};

	$scope.go_next = function(){
		$scope.ask = ($scope.ask < 7)? ++$scope.ask : $scope.ask;
	};

	$scope.send_results = function(){
		$http.post('send_results',{'results': JSON.stringify($scope.results)}).success(function(data, status, headers, config){
			//alert(JSON.stringify(data));
		});
	};
}]);

main.controller('admin',['$scope','$http',function($scope,$http){
	$scope.tab = 'analisis';

	$scope.gender_filter = 0;
	$scope.age_filter = 0;

	$scope.results = {};

	$scope.make_analisis = function(){
		$http.post('get_analisis',{'gender': $scope.gender_filter, 'age': $scope.age_filter}).success(function(data, status, headers, config){
			//alert(data);
			$scope.results = data;
		});
	};

	$scope.show_tab = function(tab){
		$scope.tab = tab;

		if(tab == 'analisis'){
			$scope.make_analisis();
		}
	};

	$scope.show_tab('analisis');

	$scope.change_gender = function(num){
		$scope.gender_filter = num;
		$scope.make_analisis();
	};

	$scope.change_age = function(num){
		$scope.age_filter = num;
		$scope.make_analisis();
	};

}]);
