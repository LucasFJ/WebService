base_url = "http://localhost/WebService/";

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