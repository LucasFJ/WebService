function AlterarNomeUsuario(){
   var nome = document.getElementById("nome").value; //valor do novo nome
   var sobrenome = document.getElementById("sobrenome").value;
   var suces = document.getElementById("sucessoNome");
   var erro = document.getElementById("erroNome"); //campo de mensagem
   nome = nome.trim();
   sobrenome = sobrenome.trim();
   var rexep = new RegExp(/^[A-Za-zà-úÀ-Ú\s]{2,20}$/i);
   if(rexep.test(nome)){
       if(rexep.test(sobrenome)){
       nome = encodeURIComponent(nome); // Permitindo o dado a entrar na url
       nome = codificarUrl(nome);
       sobrenome = encodeURIComponent(sobrenome); // Permitindo o dado a entrar na url
       sobrenome = codificarUrl(sobrenome);
       var xmlreq = CriaRequest();
        if(!xmlreq){
            erro.innerHTML = "Seu navegador não suporta Ajax.";
            suces.innerHTML = "";
        } else {
            var concat_dados = nome + "|" + sobrenome;
            xmlreq.open("GET", base_url + "ajax/AlterarDadosUsuario/1/" + concat_dados, false);
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
                              //desaparecendo com a mensagem depois de 4 segundos
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
        erro.innerHTML = "O sobrenome inserído é inválido";
        suces.innerHTML = "";
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

function NovaVerificacao(){
    var suces = document.getElementById("sucessoEmail");
    var erro = document.getElementById("erroEmail");
    var xmlreq = CriaRequest();
    if(!xmlreq){
        erro.innerHTML = "Seu navegador não suporta Ajax.";
        suces.innerHTML = "";
    } else {
        xmlreq.open("GET", base_url + "ajax/AlterarDadosUsuario/4/validacao", false);
        xmlreq.onreadystatechange = function(){
        // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4) 
            if (xmlreq.readyState == 4) {
                   if (xmlreq.status === 200) {
                     var resultado = xmlreq.responseText;
                     if(resultado === "Erro"){
                          erro.innerHTML = "Ocorreu um erro durante o envio.";
                          suces.innerHTML = "";
                      } else {
                          suces.innerHTML = "ENVIADO.";
                          //desaparecendo com a mensagem depois de 4 segundos
                          erro.innerHTML = "";
                      }
                   } else {
                       erro.innerHTML = "Ocorreu um erro durante o envio.";
                       suces.innerHTML = "";
                   }
            }
        };
        xmlreq.send(null);
    }
}

function AlterarDataNascimento(){
   var data = document.getElementById("data").value; //valor do novo nome
   var suces = document.getElementById("sucessoNascimento");
   var erro = document.getElementById("erroNomeNascimento"); //campo de mensagem
   data = data.trim();
   var rexep = new RegExp(/^[,A-Za-zà-úÀ-Ú\s0-9]{10,30}$/i);
   if(rexep.test(data)){
       data = encodeURIComponent(data); // Permitindo o dado a entrar na url
       data = codificarUrl(data);
       var xmlreq = CriaRequest();
        if(!xmlreq){
            erro.innerHTML = "Seu navegador não suporta Ajax.";
            suces.innerHTML = "";
        } else {
            xmlreq.open("GET", base_url + "ajax/AlterarDadosUsuario/2/" + data , false);
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
                              //desaparecendo com a mensagem depois de 4 segundos
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
        erro.innerHTML = "Insira uma data válida.";
        suces.innerHTML = "";
   }
   $("#sucessoNome").fadeIn(100, "swing");
   $("#erroNome").fadeIn(100, "swing");
   setTimeout(function(){
        $("#sucessoNome").fadeOut("slow", "swing");
        $("#erroNome").fadeOut("slow", "swing");
    }, 5000);
}