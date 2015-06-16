
  angular.module('TranslationApp', [])
    .factory('CSRF', function(){
        var CSRF = {};
        var param = $('head meta[name=csrf-param]').attr('content');
        var token = $('head meta[name=csrf-token]').attr('content');
        CSRF[param]=token;
        return {
            extend: function(data){
                return angular.extend(CSRF, data);
            }
        }
    })
    .constant('baseUrl', 
         $('[data-base-url]').data('baseUrl')
    )
    .controller('MainCtrl', function ($scope, $http, baseUrl, CSRF) {
        $scope.loading = true;
        $scope.languages = [];
        $scope.selectedCategory = undefined;
        $http.get(baseUrl + '/all').then(function (response) {
            $scope.categories = response.data.categories;
            $scope.languages = response.data.languages;
            $scope.selectedCategory = response.data.categories.core;
            $scope.loading = false;
        });

        $scope.addPhrase = function(){
            if(!$scope.selectedCategory.newPhrases) $scope.selectedCategory.newPhrases = [];
            var phrase = {
                key:undefined,
                translations: [],
                isNew: true
            };
            angular.forEach($scope.languages, function(lang, key){
                phrase.translations.push({
                    key: key,
                    value: undefined
                });
            });
            $scope.selectedCategory.newPhrases.push(phrase);
        };
        $scope.editPhrase = function(phrase){
            phrase.backup = phrase.translations;
            phrase.edit = true;
        };
        $scope.copyPhrase = function(phrase){
            if(!$scope.selectedCategory.newPhrases) $scope.selectedCategory.newPhrases = [];
            var copy = {};
            angular.copy(phrase, copy);
            copy.isNew = true;
            $scope.selectedCategory.newPhrases.push(copy);
        };
        $scope.cancelEdit = function(phrase){

            if(phrase.isNew){
                var newPhrases = $scope.selectedCategory.newPhrases;
                newPhrases.splice(newPhrases.indexOf(phrase), 1);
            } else {
                phrase.translations = phrase.backup;
                phrase.edit = false;
            }
        };
        $scope.savePhrase = function(phrase){
            $scope.loading = true;
            phrase.edit = false;

            var data = {
                key: phrase.key,
                category: $scope.selectedCategory.name
            };

            angular.forEach(phrase.translations, function(translation){
                data[translation.key] = translation.value
            });

            $http.post(baseUrl + '/save', CSRF.extend({
                phrase: data
            })).then(function(response){
                $scope.loading = false;
                if(phrase.isNew){
                    phrase.key = phrase.translations.en;
                    $scope.selectedCategory.newPhrases.splice($scope.selectedCategory.newPhrases.indexOf(phrase), 1);
                    $scope.selectedCategory.phrases.push(phrase);
                    console.log(phrase);
                }
            });
        };
        $scope.deletePhrase = function(phrase){
            $scope.loading = true;
            $http.post(baseUrl + '/delete', CSRF.extend({
                phrase: {
                    key: phrase.key,
                    category: $scope.selectedCategory.name
                }
            })).then(function(response){
                $scope.selectedCategory.phrases.splice($scope.selectedCategory.phrases.indexOf(phrase), 1);
                $scope.loading = false;
            });
        };
    }).directive('translationLoader', function () {
        return {
            restrict: 'E',
            replace: true,
            template: '<div class="loader" ng-class="{loading: loading}"><div class="outer-circle"></div><div class="inner-circle"></div></div>',
            scope: {
                loading: '='
            },
            link: function (scope, element) {
                var parent = element.parent()[0];
                element.css({
                    left: (parent.offsetWidth - element[0].offsetWidth) / 2 + 'px',
                    top: (parent.offsetHeight - element[0].offsetHeight) / 2 + 'px'
                });
            }
        }
    }).directive('debounce', function($timeout) {
        return {
            restrict: 'A',
            require: 'ngModel',
            priority: 99,
            link: function(scope, elm, attr, ngModelCtrl) {
                if (attr.type === 'radio' || attr.type === 'checkbox') return;

                elm.off('input');

                var debounce;
                elm.on('input', function() {
                    $timeout.cancel(debounce);
                    debounce = $timeout( function() {
                        scope.$apply(function() {
                            ngModelCtrl.$setViewValue(elm.val());
                        });
                    }, attr.debounce || 1000);
                });
                elm.on('blur', function() {
                    scope.$apply(function() {
                        ngModelCtrl.$setViewValue(elm.val());
                    });
                });
            }

        }
    });  