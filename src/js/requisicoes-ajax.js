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


//CRUD VIA AJAX DOS DADOS DA PÁGINA
function AlterarNomePagina(codigo){
   var nome = document.getElementById("nome").value; //valor do novo nome
   var suces = document.getElementById("sucessoNome");
   var erro = document.getElementById("erroNome"); //campo de mensagem
   nome = nome.trim();
   var rexep = new RegExp(/^['A-Za-zá-úÁ=Ú\s0-9 ]+$/i);
   if(rexep.test(nome) && nome != ""){
       nome = nome.replace("'", "%27");
       nome = encodeURIComponent(nome); // Permitindo o dado a entrar na url
        var xmlreq = CriaRequest();
        if(!xmlreq){
            erro.innerHTML = "Seu navegador não suporta Ajax.";
            suces.innerHTML = "";
        } else {
            xmlreq.open("GET", base_url + "ajax/alterardadopagina/1/" + codigo + "/" + nome, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var resultado = xmlreq.responseText;
                          if(resultado === "Erro"){
                              erro.innerHTML = "Ocorreu um erro durante a alteração.";
                              suces.innerHTML = "";
                          } else {
                              suces.innerHTML = "Nome alterado com sucesso";
                              erro.innerHTML = "";
                          }
                       } else {
                           erro.innerHTML = "Ocorreu um erro durante a alteração.";
                           suces.innerHTML = "";
                       }
                }
            };
            xmlreq.send(null);
        }
   } else {
        erro.innerHTML = "O nome inserído é inválido";
        suces.innerHTML = "";
   }
}

function AlterarSloganPagina(codigo){
   var slogan = document.getElementById("slogan").value; //valor do novo nome
   var suces = document.getElementById("sucessoSlogan");
   var erro = document.getElementById("erroSlogan"); //campo de mensagem
   slogan = slogan.trim();
   var rexep = new RegExp(/^[,àÀA-Za-zá-úÁ=Ú.\s0-9 ]+$/i);
   if(rexep.test(slogan) && slogan != ""){
       slogan = encodeURIComponent(slogan);
       slogan = slogan.replace(/\./g,"%2E");
       var xmlreq = CriaRequest();
        if(!xmlreq){
            erro.innerHTML = "Seu navegador não suporta Ajax.";
            suces.innerHTML = "";
        } else {
            xmlreq.open("GET", base_url + "ajax/alterardadopagina/2/" + codigo + "/" + slogan, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var resultado = xmlreq.responseText;
                          if(resultado === "Erro"){
                              erro.innerHTML = "Ocorreu um erro durante a alteração.";
                              suces.innerHTML = "";
                          } else {
                              suces.innerHTML = "Slogan alterado com sucesso";
                              erro.innerHTML = "";
                          }
                       } else {
                           erro.innerHTML = "Ocorreu um erro durante a alteração.";
                           suces.innerHTML = "";
                       }
                }
            };
            xmlreq.send(null);
        }
   } else {
       erro.innerHTML = "O slogan inserído é inválido3";
       suces.innerHTML = "";
   }
}

function AlterarDescricaoPagina(codigo){
   var desc = document.getElementById("descricao").value; //valor do novo nome
   var suces = document.getElementById("sucessoDesc");
   var erro = document.getElementById("erroDesc"); //campo de mensagem
   desc = desc.trim();
   var rexep = new RegExp(/^[,àÀA-Za-zá-úÁ=Ú.\s0-9 ]+$/i);
   if(rexep.test(desc) && desc != ""){
       //FAZENDO O DADO SER TRANSMITIVEL PELA ULR  
       desc = encodeURIComponent(desc);
       site = site.replace(/\./g,"%2E");
       var xmlreq = CriaRequest();
        if(!xmlreq){
            erro.innerHTML = "Seu navegador não suporta Ajax.";
            suces.innerHTML = "";
        } else {
            xmlreq.open("GET", base_url + "ajax/alterardadopagina/3/" + codigo + "/" + desc, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var resultado = xmlreq.responseText;
                          if(resultado === "Erro"){
                              erro.innerHTML = "Ocorreu um erro durante a alteração.";
                              suces.innerHTML = "";
                          } else {
                              suces.innerHTML = "Descrição alterado com sucesso";
                              erro.innerHTML = "";
                          }
                       } else {
                           erro.innerHTML = "Ocorreu um erro durante a alteração.";
                           suces.innerHTML = "";
                       }
                }
            };
            xmlreq.send(null);
            
        }
   } else {
        erro.innerHTML = "A descrição inserída é inválida";
        suces.innerHTML = "";
   }
}

function AlterarRamoPagina(codigo){
    var combo_ramo = document.getElementById("ramo");
    var ramo = combo_ramo.options[combo_ramo.selectedIndex].value;
    var suces = document.getElementById("sucessoRamo");
    var erro = document.getElementById("erroRamo"); 
    if(ramo > 0){
        var xmlreq = CriaRequest();
        if(!xmlreq){
            erro.innerHTML = "Seu navegador não suporta Ajax.";
            suces.innerHTML = "";
        } else {
            xmlreq.open("GET", base_url + "ajax/alterardadopagina/5/" + codigo + "/" + ramo, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var resultado = xmlreq.responseText;
                          if(resultado === "Erro"){
                              erro.innerHTML = "Ocorreu um erro durante a alteração.";
                              suces.innerHTML = "";
                          } else {
                              suces.innerHTML = "Ramo alterado com sucesso";
                              erro.innerHTML = "";
                          }
                       } else {
                           erro.innerHTML = "Ocorreu um erro durante a alteração.";
                           suces.innerHTML = "";
                       }
                }
            };
            xmlreq.send(null);
            
        }
    } else {
        erro.innerHTML = "O ramo inserido é inválido";
        suces.innerHTML = "";
    }
}

function AlterarLayoutPagina(codigo){
    var combo_layout = document.getElementById("layout");
    var layout = combo_layout.options[combo_layout.selectedIndex].value;
    var suces = document.getElementById("sucessoLayout");
    var erro = document.getElementById("erroLayout"); 
    if(layout > 0){
        var xmlreq = CriaRequest();
        if(!xmlreq){
            erro.innerHTML = "Seu navegador não suporta Ajax.";
            suces.innerHTML = "";
        } else {
            xmlreq.open("GET", base_url + "ajax/alterardadopagina/6/" + codigo + "/" + layout, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var resultado = xmlreq.responseText;
                          if(resultado === "Erro"){
                              erro.innerHTML = "Ocorreu um erro durante a alteração.";
                              suces.innerHTML = "";
                          } else {
                              suces.innerHTML = "Layout alterado com sucesso";
                              erro.innerHTML = "";
                          }
                       } else {
                           erro.innerHTML = "Ocorreu um erro durante a alteração.";
                           suces.innerHTML = "";
                       }
                }
            };
            xmlreq.send(null);
            
        }
    } else {
        erro.innerHTML = "O layout inserido é inválido";
        suces.innerHTML = "";
    }
}

function AlterarSitePagina(codigo){
   var site = document.getElementById("site").value; //valor do novo nome
   var suces = document.getElementById("sucessoSite");
   var erro = document.getElementById("erroSite"); //campo de mensagem
   site = site.trim();
   var rexep = new RegExp(/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|com.br|.net)$)(:(\d+))?\/?/i);
   var rexep2 = new RegExp(/^(www)((\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|com.br|.net)$)(:(\d+))?\/?/i);
   if(rexep.test(site) || site == "" || rexep2.test(site)){
       site = encodeURIComponent(site); // Permitindo o dado a entrar na url
       //site = site.replace("'", "%27");
       site = site.replace(/\./g,"%2E");
        var xmlreq = CriaRequest();
        if(!xmlreq){
            erro.innerHTML = "Seu navegador não suporta Ajax.";
            suces.innerHTML = "";
        } else {
            xmlreq.open("GET", base_url + "ajax/alterardadopagina/4/" + codigo + "/" + site, false);
            xmlreq.onreadystatechange = function(){
            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                if (xmlreq.readyState == 4) {
                       if (xmlreq.status === 200) {
                          var resultado = xmlreq.responseText;
                          if(resultado === "Erro"){
                              erro.innerHTML = "Ocorreu um erro durante a alteração.";
                              suces.innerHTML = "";
                          } else {
                              suces.innerHTML = "Site alterado com sucesso";
                              erro.innerHTML = "";
                          }
                       } else {
                           erro.innerHTML = "Ocorreu um erro durante a alteração. Evite utilizar 'http://'";
                           suces.innerHTML = "";
                       }
                }
            };
            xmlreq.send(null);
        }
   } else {
        erro.innerHTML = "O site inserído é inválido";
        suces.innerHTML = "";
   }
}

function AlterarLocalidadePagina(codigo){
    var codigo_cep = document.getElementById("codigo_logradouro").value;
    var numero = document.getElementById("numero").value;
    numero = numero.trim(numero);
    var complemento = document.getElementById("complemento").value;
    complemento = complemento.trim();
    var suces = document.getElementById("sucessoLocal");
    var erro = document.getElementById("erroLocal"); //campo de mensagem
    //var regexp = new RegExp(/^[,àÀA-Za-zá-úÁ=Ú.\s0-9 ]+$/i); 
    var regexp = new RegExp(/^[\s0-9]+$/i);
    if(regexp.test(codigo_cep) && codigo_cep != ""){
        if(regexp.test(numero) || numero == ""){
            regexp = new RegExp(/^[A-Za-zá-úÁ=Ú.\s0-9]+$/i);
            if(regexp.test(complemento) || complemento == ""){
                var concat_dados = codigo_cep + "|" + numero + "|" + complemento;
                concat_dados = encodeURIComponent(concat_dados);
                       var xmlreq = CriaRequest();
                        if(!xmlreq){
                            erro.innerHTML = "Seu navegador não suporta Ajax.";
                            suces.innerHTML = "";
                        } else {
                            xmlreq.open("GET", base_url + "ajax/alterardadopagina/7/" + codigo + "/" + concat_dados, false);
                            xmlreq.onreadystatechange = function(){
                            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                                if (xmlreq.readyState == 4) {
                                       if (xmlreq.status === 200) {
                                          var resultado = xmlreq.responseText;
                                          if(resultado === "Erro"){
                                              erro.innerHTML = "Ocorreu um erro durante a alteração.";
                                              suces.innerHTML = "";
                                          } else {
                                              suces.innerHTML = "Localidade alterada com sucesso";
                                              erro.innerHTML = "";
                                          }
                                       } else {
                                           erro.innerHTML = "Ocorreu um erro durante a alteração.";
                                           suces.innerHTML = "";
                                       }
                                }
                            };
                            xmlreq.send(null);

                        }
            } else {
                erro.innerHTML = "O complemento deve ser alfanumérico ou vazio.";
                suces.innerHTML = "";
            }
        } else {
            erro.innerHTML = "O número deve ser numérico ou vazio.";
            suces.innerHTML = "";
        }
    } else {
        erro.innerHTML = "É obrigatório a utilização de um CEP.";
        suces.innerHTML = "";
    }
}

function AlterarTelefonePagina(codigo){
    var telefone = document.getElementById("telefone").value;
    var celular = document.getElementById("celular").value;
    var suces = document.getElementById("sucessoTele");
    var erro = document.getElementById("erroTele");
    telefone = telefone.replace(/[\s( )-]/g,""); //removendo a mask
    telefone = telefone.trim();
    celular = celular.replace(/[\s( )-]/g,""); // removendo a mask
    celular = celular.trim();
    var regexp1  = new RegExp(/^[0-9]{10}$/);
    var regexp2  = new RegExp(/^[0-9]{11}$/);
    if(regexp1.test(telefone) || telefone == ""){
        if(regexp2.test(celular) || celular == ""){
            var concat_dados = telefone + " | " + celular;
            concat_dados = encodeURIComponent(concat_dados);
            var xmlreq = CriaRequest();
                        if(!xmlreq){
                            erro.innerHTML = "Seu navegador não suporta Ajax.";
                            suces.innerHTML = "";
                        } else {
                            xmlreq.open("GET", base_url + "ajax/alterardadopagina/8/" + codigo + "/" + concat_dados, false);
                            xmlreq.onreadystatechange = function(){
                            // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
                                if (xmlreq.readyState == 4) {
                                       if (xmlreq.status === 200) {
                                          var resultado = xmlreq.responseText;
                                          if(resultado === "Erro"){
                                              erro.innerHTML = "Ocorreu um erro durante a alteração.";
                                              suces.innerHTML = "";
                                          } else {
                                              suces.innerHTML = "Telefone e celular alterados com sucesso";
                                              erro.innerHTML = "";
                                          }
                                       } else {
                                           erro.innerHTML = "Ocorreu um erro durante a alteração.";
                                           suces.innerHTML = "";
                                       }
                                }
                            };
                            xmlreq.send(null);

                        }
        } else {
            erro.innerHTML = "O celular inserido é inválido";
            suces.innerHTML = "";
        }
    } else {
        erro.innerHTML = "O telefone inserido é inválido";
        suces.innerHTML = "";
    }
}