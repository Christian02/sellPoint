
var app = angular.module('purchasesApp',['ui.bootstrap'],function($interpolateProvider){
	$interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

});
app.filter('startFrom',function(){
	return function(data,start){
		if (data)
			return data.slice(start);
	}
});
app.constant('API_URL','http://localhost/prueba/public/');
