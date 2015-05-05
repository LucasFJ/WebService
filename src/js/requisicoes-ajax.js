//Função de criar o item xmlrequest responsavel por executar o ajax
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
        alert("Seu navegador não suporta ajax");
    } else {
        return request;
    }
} 


function AdministradorAjax() {
    var xmlreq = CriaRequest();
    var offset = 0;
    
    this.ConsultarEndereco = function() {
        //IRÁ ENVIAR UM NUMERO DE CEP E RETORNAR logradouro, bairro, cidade e uf
    }
    
    this.CarregarPaginas = function(){
        //IRÁ RETORNAR AS FAIXADAS DAS PÁGINAS NA HOME
    }
    
    this.RecarregarPaginas = function(){
        //IRÁ DELETAR AS FAIXADAS JÁ CARREDAS E SUBSTITUIR PELAS NOVAS 
        //DE ACORDO COM OS NOVOS REQUISITOS DE BUSCA
    }
}