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
    CarregarBoxRamo();
    CarregarBoxEstado();
    $('select').material_select();
    
    // Oculta e permite Exibir/Ocultar a busca aprimorada
    $('#buscaAdicional').hide();
    $('#btnAdicional').click(mostrarAdicional);
    function mostrarAdicional(){
            $('#buscaAdicional').toggle();
    }
    
    //Controla o abre/fecha dos itens da SideNav
    $('.liMenu').click(function(){
    if($(this).hasClass('active')){
        $(this).children('.collapsible-body').hide(400);
        $(this).removeClass('active'); 
    } else {
        $(this).removeClass('active');
        $('.active').children('.collapsible-body').hide(400);
        $(this).addClass('active');
        $('.active').removeClass('active');
    }
    });
    
    //Máscaras de formulários com jQuery Mask
    $('#telefone').mask('(00) 0000-0000');
    $('#celular').mask('(00) 00000-0000');
    $('#cep').mask('00000-000');

});
