//Requisições ajax utilizadas apenas na view busca

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
                        var resultado = xmlreq.responseText;
                        options_cidade.innerHTML = resultado;
                        $("#cidade").material_select();
                        if(resultado = " "){
                             var options_bairro = document.getElementById("container-bairro");
                             options_bairro.innerHTML = " ";
                             $("#bairro").material_select("destroy");
                        }
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
    var options_bairro = document.getElementById("container-bairro");
     if(!xmlreq){
            alert("Seu navegador não suporta Ajax!");
        } else {
            var options_cidade = document.getElementById("cidade");
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
        $("#bairro").material_select();
}

//UTILIZADO APENAS NA NA VIEW DE BUSCA E INICIAL
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
        
        $('.telefone').mask('(00) 0000-0000');
        $('.celular').mask('(00) 00000-0000');
        $('#cep').mask('00000-000');
    } 
    