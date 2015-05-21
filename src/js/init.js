// Initialize collapse button
$('.button-collapse').sideNav();
 
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 180 // Creates a dropdown of 15 years to control year
  });

$(document).ready(function() {
    // The "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
    
    // Inicializa o elemento Form Select do Materialize
    $('select').material_select();
    
    // Oculta e permite Exibir/Ocultar a busca aprimorada
    $('#buscaAdicional').hide();
    $('#btnAdicional').click(mostrarAdicional);
    function mostrarAdicional(){
            $('#buscaAdicional').toggle();
    }
});