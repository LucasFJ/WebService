//Requisições ajax utilizadas apenas na view de crud de página
//
//Funções auxiliares ao cadastro de produto
function CarregarEndereco(){
    var input_cep = document.getElementById("cep");
    var conteudo_cep = input_cep.value;
    // Inputs
     var rua = document.getElementById('rua');
     var bairro = document.getElementById('bairro');
     var cidade = document.getElementById('cidade');
     var uf = document.getElementById('uf');
     var cod_log = document.getElementById('codigo_logradouro');
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
                          var $resultado = xmlreq.responseText;
                          if($resultado == "Erro"){
                              alert('O CEP indicado é invalido')
                              rua.value = "";
                              bairro.value = "";
                              cidade.value = "";
                              uf.value = "";
                              cod_log.value = "";
                          } else {
                              var $array_dados = $resultado.split("+");
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
    }
}
function AlterarCardExemplo(cores){
    var arrayCores = cores.split(" ");
    var container_layout = document.getElementById("layout");
    var index = container_layout.selectedIndex;
    var cardTeste = document.getElementById("cardTeste");
    cardTeste.className = "btn "+ arrayCores[index] +" large" ;
}

//Funções ligadas ao modificar as informações
function AlterarNomePagina(codigo){
   var nome = document.getElementById("nome").value; //valor do novo nome
   var suces = document.getElementById("sucessoNome");
   var erro = document.getElementById("erroNome"); //campo de mensagem
   nome = nome.trim();
   var rexep = new RegExp(/^[ªº\.,'!?&+\-A-Za-zà-úÀ-Ú\s0-9]{2,25}$/i);
   if(rexep.test(nome) && nome != ""){
       nome = encodeURIComponent(nome); // Permitindo o dado a entrar na url
       nome = codificarUrl(nome);
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
                              erro.innerHTML = "Ocorreu um erro durante a alteração.2";
                              suces.innerHTML = "";
                          } else {
                              suces.innerHTML = "ALTERADO";
                              //desaparecendo com a mensagem depois de 4 segundos
                              erro.innerHTML = "";
                          }
                       } else {
                           erro.innerHTML = "Ocorreu um erro durante a alteração.1";
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
   $("#sucessoNome").fadeIn(100, "swing");
   $("#erroNome").fadeIn(100, "swing");
   setTimeout(function(){
        $("#sucessoNome").fadeOut("slow", "swing");
        $("#erroNome").fadeOut("slow", "swing");
    }, 5000);
}
function AlterarSloganPagina(codigo){
   var slogan = document.getElementById("slogan").value; //valor do novo nome
   var suces = document.getElementById("sucessoSlogan");
   var erro = document.getElementById("erroSlogan"); //campo de mensagem
   slogan = slogan.trim();
   var rexep = new RegExp(/^[ªº\.,'!?&+\-A-Za-zà-úÀ-Ú\s0-9]{2,40}$/i);
   if(rexep.test(slogan) && slogan != ""){
       slogan = encodeURIComponent(slogan);
       slogan = codificarUrl(slogan);
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
                              suces.innerHTML = "ALTERADO";
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
       erro.innerHTML = "O slogan inserído é inválido";
       suces.innerHTML = "";
   }
   $("#sucessoSlogan").fadeIn(100, "swing");
   $("#erroSlogan").fadeIn(100, "swing");
   setTimeout(function(){
        $("#sucessoSlogan").fadeOut("slow", "swing");
        $("#erroSlogan").fadeOut("slow", "swing");
    }, 5000);
}
function AlterarDescricaoPagina(codigo){
   var desc = document.getElementById("descricao").value; //valor do novo nome
   var suces = document.getElementById("sucessoDesc");
   var erro = document.getElementById("erroDesc"); //campo de mensagem
   desc = desc.trim();
   var rexep = new RegExp(/^[\(\)\\/ªº\.,"'!?@#$%*&+\-A-Za-zà-úÀ-Ú\s0-9]{2,180}$/i);
  // desc = desc.replace("\r", "ROW");
   desc = desc.replace(/\r?\n/g, "%5Cn"); 
    if(rexep.test(desc) && desc != ""){
       //FAZENDO O DADO SER TRANSMITIVEL PELA ULR
       desc = encodeURIComponent(desc);
       desc = codificarUrl(desc);
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
                              erro.innerHTML = "Ocorreu um erro durante a alteração.1";
                              suces.innerHTML = "";
                          } else {
                              suces.innerHTML = "ALTERADO";
                              erro.innerHTML = "";
                          }
                       } else {
                           erro.innerHTML = "Ocorreu um erro durante a alteração.2";
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
   $("#sucessoDesc").fadeIn(100, "swing");
   $("#erroDesc").fadeIn(100, "swing");
   setTimeout(function(){
        $("#sucessoDesc").fadeOut("slow", "swing");
        $("#erroDesc").fadeOut("slow", "swing");
    }, 5000);
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
                              suces.innerHTML = "ALTERADO";
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
   $("#sucessoRamo").fadeIn(100, "swing");
   $("#erroRamo").fadeIn(100, "swing");
   setTimeout(function(){
        $("#sucessoRamo").fadeOut("slow", "swing");
        $("#erroRamo").fadeOut("slow", "swing");
    }, 5000);
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
                              suces.innerHTML = "ALTERADO";
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
   $("#sucessoLayout").fadeIn(100, "swing");
   $("#erroLayout").fadeIn(100, "swing");
   setTimeout(function(){
        $("#sucessoLayout").fadeOut("slow", "swing");
        $("#erroLayout").fadeOut("slow", "swing");
    }, 5000);
}
function AlterarSitePagina(codigo){
   var site = document.getElementById("site").value; //valor do novo nome
   var suces = document.getElementById("sucessoSite");
   var erro = document.getElementById("erroSite"); //campo de mensagem
   site = site.trim();
   var rexep2 = new RegExp(/^(www)((\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|com.br|.net)$)(:(\d+))?\/?/i);
   if(site == "" || rexep2.test(site)){
       site = encodeURIComponent(site); // Permitindo o dado a entrar na url
       site = codificarUrl(site);
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
                              suces.innerHTML = "ALTERADO";
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
   $("#sucessoSite").fadeIn(100, "swing");
   $("#erroSite").fadeIn(100, "swing");
   setTimeout(function(){
        $("#sucessoSite").fadeOut("slow", "swing");
        $("#erroSite").fadeOut("slow", "swing");
    }, 5000);
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
    var regexp = new RegExp(/^[0-9]{1,7}$/i);
    if(regexp.test(codigo_cep) && codigo_cep != ""){
        if(regexp.test(numero)){
            regexp = new RegExp(/^[\.\-ºªA-Za-zà-úÀ-Ú\s0-9]{2,25}$/i);
            if(regexp.test(complemento) || complemento == ""){
                //Colocando um valor vazio para impedir erro no explode do PHP
                complemento = (complemento != "") ? codificarUrl(complemento) : " ";
                numero = (numero != "") ? numero : " ";
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
                                              suces.innerHTML = "ALTERADO";
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
            erro.innerHTML = "O número deve ser numérico.";
            suces.innerHTML = "";
        }
    } else {
        erro.innerHTML = "É obrigatório a utilização de um CEP.";
        suces.innerHTML = "";
    }
    $("#sucessoLocal").fadeIn(100, "swing");
    $("#erroLocal").fadeIn(100, "swing");
    setTimeout(function(){
        $("#sucessoLocal").fadeOut("slow", "swing");
        $("#erroLocal").fadeOut("slow", "swing");
    }, 5000);
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
                                              suces.innerHTML = "ALTERADO";
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
   $("#sucessoTele").fadeIn(100, "swing");
   $("#erroTele").fadeIn(100, "swing");
   setTimeout(function(){
        $("#sucessoTele").fadeOut("slow", "swing");
        $("#erroTele").fadeOut("slow", "swing");
    }, 5000);
}
function ExcluirPagina(codigo){
    var suces = document.getElementById("sucessoExcluir");
    var erro = document.getElementById("erroExcluir");
    var xmlreq = CriaRequest();
    if(!xmlreq){
        erro.innerHTML = "Seu navegador não suporta Ajax.";
        suces.innerHTML = "";
    } else {
        xmlreq.open("GET", base_url + "ajax/ExcluirPagina/" + codigo, false);
        xmlreq.onreadystatechange = function(){
        // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
            if (xmlreq.readyState == 4) {
                   if (xmlreq.status === 200) {
                      var resultado = xmlreq.responseText;
                      if(resultado === "Erro"){
                          erro.innerHTML = "Ocorreu um erro durante a operação.";
                          suces.innerHTML = "";
                      } else {
                          suces.innerHTML = "Enviamos um e-mail para confirmar o processo.";
                          erro.innerHTML = "";
                      }
                   } else {
                       erro.innerHTML = "Ocorreu um erro durante a operação.";
                       suces.innerHTML = "";
                   }
            }
        };
        xmlreq.send(null);
        
    }
   $("#sucessoExcluir").fadeIn(100, "swing");
   $("#erroExcluir").fadeIn(100, "swing");
   setTimeout(function(){
        $("#sucessoExcluir").fadeOut("slow", "swing");
        $("#erroExcluir").fadeOut("slow", "swing");
    }, 5000);
}
function AlterarImagemPagina(codigo){
    //var imagemAntiga = document.getElementById("imagemantiga").value;
    var suces = document.getElementById("sucessoImagem");
    var erro = document.getElementById("erroImagem");
    $('#alterarimagem').ajaxForm({ 
        //target: 
        success:function(data) 
        {
            if(data === "Erro"){
                erro.innerHTML = "Não foi possivel alterar a imagem.";
                suces.innerHTML = "";
            } else {
               $("#imagempagina").attr("src", base_url + "src/imagens/pagina/perfil/" + data);
               //atualiza tambem o value do imagem antiga para nao deixar de deletar
               var imagemantiga = document.getElementById("imagemantiga");
               imagemantiga.value = data;
               //exibindo as menasgens de sucesso
               erro.innerHTML = "";
               suces.innerHTML = "alterada com sucesso.";
           }
        }
        // o callback será no elemento com o id #visualizar 
        }).submit();
        $("#sucessoImagem").fadeIn(100, "swing");
        $("#erroImagem").fadeIn(100, "swing");
        setTimeout(function(){
             $("#sucessoImagem").fadeOut("slow", "swing");
             $("#erroImagem").fadeOut("slow", "swing");
         }, 5000);
}