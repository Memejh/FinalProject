angular.module('MyApp',['ngMaterial', 'ngMessages', 'material.svgAssetsCache']).controller('AppCtrl', function() {
  this.myDate = new Date();
  this.isOpen = false;
});
