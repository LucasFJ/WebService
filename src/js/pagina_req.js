//Funcoes ligadas aos comentarios
function InserirComentario(codigoPagina){
    var conteudo_mensagem = document.getElementById("comentario").value;
    var rexep = new RegExp(/^[ªº\.,'!?&+\-A-Za-zà-úÀ-Ú\s0-9]{4,150}$/i);
    if(rexep.test(conteudo_mensagem)){
       conteudo_mensagem = encodeURIComponent(conteudo_mensagem);
       conteudo_mensagem = codificarUrl(conteudo_mensagem);
       var xmlreq = CriaRequest();
       if(!xmlreq){
            //erro.innerHTML = "Seu navegador não suporta Ajax.";
        } else {
            xmlreq.open("GET", base_url + "ajax/InserirComentario/" + codigoPagina + "/" + conteudo_mensagem, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var meu_comentario = document.getElementById("meucomentario");
                          var resultado = xmlreq.responseText;
                          if(resultado === "Vazio"){
                              //nada ocorreu
                          } else {
                              meu_comentario.innerHTML = resultado;
                          }
                       } else {
                           //erro.innerHTML = "Ocorreu um erro durante a alteração.";
                       }
                }
            };
            xmlreq.send(null);
        }
    } else {
        //o comentário inserido é inválido
         //erro.innerHTML = "Insira um comentário válido";
    }
}

function ExcluirComentario(codigoPagina){
    var xmlreq = CriaRequest();
       if(!xmlreq){
            //erro.innerHTML = "Seu navegador não suporta Ajax.";
        } else {
            xmlreq.open("GET", base_url + "ajax/excluirComentario/" + codigoPagina, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var meu_comentario = document.getElementById("meucomentario");
                          var resultado = xmlreq.responseText;
                          if(resultado === "Erro"){
                              //nada ocorreu
                          } else {
                              meu_comentario.innerHTML = resultado;
                          }
                       } else {
                           //erro.innerHTML = "Ocorreu um erro durante a alteração.";
                       }
                }
            };
            xmlreq.send(null);
        }
}

function CarregarMeuComentario(codigoPagina){
    var xmlreq = CriaRequest();
       if(!xmlreq){
            //erro.innerHTML = "Seu navegador não suporta Ajax.";
        } else {
            xmlreq.open("GET", base_url + "ajax/CarregarMeuComentario/" + codigoPagina, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var meu_comentario = document.getElementById("meucomentario");
                          var resultado = xmlreq.responseText;
                          if(resultado === "Vazio"){
                              //nada ocorreu
                          } else {
                              meu_comentario.innerHTML = resultado;
                          }
                       } else {
                           //erro.innerHTML = "Ocorreu um erro durante a alteração.";
                       }
                }
            };
            xmlreq.send(null);
        }
}

function CarregarComentarios(codigoPagina){
    var xmlreq = CriaRequest();
       if(!xmlreq){
            //erro.innerHTML = "Seu navegador não suporta Ajax.";
        } else {
            var offset = document.getElementsByClassName('comentario').length;
            xmlreq.open("GET", base_url + "ajax/CarregarComentarios/" + codigoPagina + "/" + offset, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var comentarios = document.getElementById("outroscomentarios");
                          var resultado = xmlreq.responseText;
                          if(resultado === "Vazio"){
                              //nada ocorreu
                          } else {
                              comentarios.innerHTML = resultado;
                          }
                       } else {
                           //erro.innerHTML = "Ocorreu um erro durante a alteração.";
                       }
                }
            };
            xmlreq.send(null);
        }
}


//funcoes ligadas ao mapa
var map;
function IniciarMapa(lat, long){
                var latlng = new google.maps.LatLng(lat,long);
                var options = {
                    zoom: 16,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("mapa"), options);
                //Colocando um marcador
                 var marker = new google.maps.Marker({
                 position: new google.maps.LatLng(lat, long),
                 title: "Local da empresa",
                    map: map
            });
 }
 
 function alteraEstrela(){
            var valor = parseInt($('.thumb').children('.value').text());
            var estrela = document.getElementsByClassName('estrela');
            var index = 0;
            while(index<5){
                if(index < valor){
                    estrela[index].className = 'mdi-action-star-rate estrela amber-text text-darken-2 rateServico';
                } else {
                    estrela[index].className = 'mdi-action-star-rate estrela black-text rateServico';
                }
                index++;
            }
        }