"use strict";

angular
    .module('manivo', [
        'ngAnimate',
        'ngRoute',
        'ui.bootstrap',
        'ui.select'
    ])
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/', {
                'templateUrl': 'js/views/index.html',
                'controller': 'IndexCtrl'
            })
            .otherwise({
                redirectTo: '/'
            })
        ;
    }])
;
