base_url = "http://localhost/WebService/";


function CriaRequest() {
    try{
        request = new XMLHttpRequest();
    } catch(IEAtual){
        try{
            request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(IEAntigo) {
            try{
                request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(falha) {
                request = false; //navegador não suporta ajax
            }
        }
    }
if(!request){
        //alert("Seu navegador não suporta ajax");
        return false;
    } else {
        return request;
    }
} 

//Funções básicas partilhadas por todos os arquivos ou quase.
// Initialize collapse button
$('.button-collapse').sideNav();
 
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
$('.telefone').mask('(00) 0000-0000');
$('.celular').mask('(00) 00000-0000');
$('#cep').mask('00000-000');

function codificarUrl(str){
    str = str.replace(/!/g, "%21");
    str = str.replace(/'/g, "%27");
    str = str.replace(/\./g,"%2E");
    str = str.replace(/\(/g,"%28");
    str = str.replace(/\)/g,"%29");
    str = str.replace(/\*/g,"%2A");
    str = str.replace(/\\/g, "%5C");
    return str;
}