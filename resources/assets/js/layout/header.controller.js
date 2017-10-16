
    'use strict';
    var angular = require('angular');


    angular
        .module('app.layout')
        .controller('HeaderController', HeaderController);

    HeaderController.$inject = ['$scope','$state','AuthService'];

    /* @ngInject */
    function HeaderController($scope, $state, AuthService) {
        var vm = this;

        vm.toggleMenu = toggleMenu;
        vm.getUser = getUser;

        /////////////////////////////////////////////////
        activate();

        function activate() {

            //$scope.$watch( AuthService.currentUser, function ( currentUser ) {
              //console.log(currentUser);
            //});
        }

        /////////////////////////////////////////////////


        //Toggle menu
        //
        function toggleMenu() {
          $('#burgerMenu').toggleClass('open');
          $('#navigation').slideToggle(400);
        }

        function getUser() {
          return AuthService.currentUser();
        }



    }