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
        //alert("Seu navegador não suporta ajax");
        return false;
    } else {
        return request;
    }
} 

//VARIAVEL GLOBAL CONTENDO A URL DO SITE ATUALMENTE
base_url = "http://localhost/WebService/";

function CarregarCartoes(ramo, estado, cidade, bairro, ordenacao, nome){
        //IRÁ RETORNAR AS FAIXADAS DAS PÁGINAS NA HOME
        var xmlreq = CriaRequest();
        var msgErro = document.getElementById("msgErro");
        if(!xmlreq){
            msgErro.innerHTML = "Seu navegador não suporta Ajax!";
        } else {
           var containerCartoes = document.getElementById("container-cartoes");
           var $offset = document.getElementsByClassName("cartao").length;
           xmlreq.open("GET", base_url + "ajax/carregarCartoes/" +
                $offset + "/" + ramo + "/" + estado + "/" + cidade + "/" + bairro + "/" +
                ordenacao + "/" + nome, false);
           xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          resultado = xmlreq.responseText;
                          if(resultado === "Vazio"){
                              msgErro.innerHTML = "Não há mais páginas para serem exibidas.";
                          } else {
                              containerCartoes.innerHTML +=  resultado;
                          }
                       } else {
                           msgErro.innerHTML = "Ocorreu um erro durante a requisição Ajax";
                       }
                }
            };
            xmlreq.send(null);
           
        }
    } 
function CarregarBoxRamo(){
    var xmlreq = CriaRequest();
    var options_ramo = document.getElementById("container-ramo");
     if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            xmlreq.open("GET", base_url + "ajax/carregarOpcoesRamo", false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          options_ramo.innerHTML = xmlreq.responseText;
                       } else {
                           alert('Não foi possivel carregar os ramos');
                       }
                }
            };
            xmlreq.send(null);
        }
}
function CarregarBoxEstado(){
    var xmlreq = CriaRequest();
    var options_estado = document.getElementById("container-estado");
     if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            xmlreq.open("GET",  base_url + "ajax/carregarOpcoesEstado", false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          options_estado.innerHTML = xmlreq.responseText;                           
                       } else {
                           alert('Não foi possivel carregar os ramos');
                       }
                }
            };
            xmlreq.send(null);
        }
}
function CarregarBoxCidade(){
    var xmlreq = CriaRequest();
    var options_cidade = document.getElementById("container-cidade");
     if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            var options_estado = document.getElementById("container-estado");
            var codigo = options_estado.options[options_estado.selectedIndex].value;
            xmlreq.open("GET", base_url + "ajax/carregarOpcoesCidade/" + codigo, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          options_cidade.innerHTML = xmlreq.responseText;
                       } else {
                           alert('Não foi possivel carregar os ramos');
                       }
                }
            };
            xmlreq.send(null);
        }
}
function CarregarBoxBairro(){
    var xmlreq = CriaRequest();
    var options_bairro = document.getElementById("container-cidade");
     if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            var options_cidade = document.getElementById("container-cidade");
            var codigo = options_cidade.options[options_cidade.selectedIndex].value;
            xmlreq.open("GET", base_url + "ajax/carregarOpcoesBairro/" + codigo, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          options_bairro.innerHTML = xmlreq.responseText;                           
                       } else {
                           alert('Não foi possivel carregar os ramos');
                       }
                }
            };
            xmlreq.send(null);
        }
}

function CarregarEndereco(){
    var input_cep = document.getElementById("cep");
    var conteudo_cep = input_cep.value;
    // Inputs
     var rua = document.getElementById('rua');
     var bairro = document.getElementById('bairro');
     var cidade = document.getElementById('cidade');
     var uf = document.getElementById('uf');
     var cod_log = document.getElementById('codigo_logradouro');
     //Labels
     var labels_cidade = document.getElementsByClassName('localidade');
    conteudo_cep = conteudo_cep.replace(/[^\d]+/g, "");
    if(conteudo_cep.length == 8){
        var xmlreq = CriaRequest();
        if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            xmlreq.open("GET", base_url + "ajax/carregarEndereco/" + conteudo_cep, false);
            xmlreq.onreadystatechange = function(){// Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          $resultado = xmlreq.responseText;
                          if($resultado == "Erro"){
                              alert('O CEP indicado é invalido')
                              rua.value = "";
                              bairro.value = "";
                              cidade.value = "";
                              uf.value = "";
                              cod_log.value = "";
                              labels_cidade.item(0).innerHTML = "Rua";
                              labels_cidade.item(1).innerHTML = "Bairro";
                              labels_cidade.item(2).innerHTML = "Cidade";
                              labels_cidade.item(3).innerHTML = "UF";
                          } else {
                              $array_dados = $resultado.split("+");
                              rua.value = $array_dados[0];
                              bairro.value = $array_dados[1];
                              cidade.value = $array_dados[2];
                              uf.value = $array_dados[3];
                              cod_log.value = $array_dados[4];
                              for (x = 0; x < 4; x++){
                                  labels_cidade.item(x).innerHTML = "";
                              }
                          }
                       } else {
                           alert('Não foi possivel carregar os ramos');
                       }
                }
            };
            xmlreq.send(null);
        }
    } else {
        cod_log.value = "";
        rua.value = "";
        bairro.value = "";
        cidade.value = "";
        uf.value = "";
        cod_log.value = "";
        labels_cidade.item(0).innerHTML = "Rua";
        labels_cidade.item(1).innerHTML = "Bairro";
        labels_cidade.item(2).innerHTML = "Cidade";
        labels_cidade.item(3).innerHTML = "UF";
    }
}