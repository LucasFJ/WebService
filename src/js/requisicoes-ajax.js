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



function CarregarCartoes(ramo, estado, cidade, bairro, ordenacao, nome){
        //IRÁ RETORNAR AS FAIXADAS DAS PÁGINAS NA HOME
        xmlreq = CriaRequest();
        msgErro = document.getElementById("msgErro");
        if(!xmlreq){
            msgErro.innerHTML = "Seu navegador não suporta Ajax!";
        } else {
           containerCartoes = document.getElementById("container-cartoes");
           $offset = document.getElementsByClassName("cartao").length;
           xmlreq.open("GET", "http://localhost/WebService/ajax/carregarCartoes/" +
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
    xmlreq = CriaRequest();
    options_ramo = document.getElementById("container-ramo");
     if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            xmlreq.open("GET", "http://localhost/WebService/ajax/carregarOpcoesRamo", false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          options_ramo.innerHTML = xmlreq.responseText;
                          $('#container-ramo').material_select('destroy');
                          $('#container-ramo').material_select();
                       } else {
                           alert('Não foi possivel carregar os ramos');
                       }
                }
            };
            xmlreq.send(null);
        }
}
function CarregarBoxEstado(){
    xmlreq = CriaRequest();
    options_estado = document.getElementById("container-estado");
     if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            xmlreq.open("GET", "http://localhost/WebService/ajax/carregarOpcoesEstado", false);
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
    xmlreq = CriaRequest();
    options_cidade = document.getElementById("container-cidade");
     if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            options_estado = document.getElementById("container-estado");
            codigo = options_estado.options[options_estado.selectedIndex].value;
            xmlreq.open("GET", "http://localhost/WebService/ajax/carregarOpcoesCidade/" + codigo, false);
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
    xmlreq = CriaRequest();
    options_bairro = document.getElementById("container-cidade");
     if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            options_cidade = document.getElementById("container-cidade");
            codigo = options_cidade.options[options_cidade.selectedIndex].value;
            xmlreq.open("GET", "http://localhost/WebService/ajax/carregarOpcoesBairro/" + codigo, false);
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
    conteudo_cep = conteudo_cep.replace(/[^\d]+/g, "");
    if(conteudo_cep.length == 8){
        var xmlreq = CriaRequest();
        if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
             rua = document.getElementById('rua');
             bairro = document.getElementById('bairro');
             cidade = document.getElementById('cidade');
             uf = document.getElementById('uf');
             cod_log = document.getElementById('codigo_logradouro');
            xmlreq.open("GET", "http://localhost/WebService/ajax/carregarEndereco/" + conteudo_cep, false);
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
                          } else {
                              $array_dados = $resultado.split("+");
                              rua.value = $array_dados[0];
                              bairro.value = $array_dados[1];
                              cidade.value = $array_dados[2];
                              uf.value = $array_dados[3];
                              cod_log.value = $array_dados[4];
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
    }
}