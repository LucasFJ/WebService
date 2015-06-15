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