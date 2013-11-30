'use strict';

angular.module('angularAppApp')
    .controller('MainCtrl', function ($scope) {
        $scope.messages = [];

        var socket;
        socket = io.connect('http://localhost:2222');
        socket.on('message', function (msg) {
            $scope.$apply(function() {
                $scope.messages.unshift(msg);
            })
        });
    });
