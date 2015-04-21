// Initialize collapse button
$('.button-collapse').sideNav();

$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
 
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 180 // Creates a dropdown of 15 years to control year
  });

$(document).ready(function() {
  $('select').material_select();
});
