//Requisições ajax utilizadas apenas na view de crud de página

function CarregarImagemProduto(codigo){
    var filepath = document.getElementById("filepath").value;
    var rexep = new RegExp(/.png|.jpg$/i); //termina com a extensão jpg ou png
    var btnEnviar = document.getElementById("btnEnviar");
    var imagemUpload = document.getElementById("imagemUpload");
    if(rexep.test(filepath)){
        $('#formImagem').ajaxForm({ 
        url: base_url + "/ajax/UploadImagemProduto/" + codigo,
        success:function(data) 
        {
               if(data != "Erro"){
               $("#imagemproduto").attr("src", base_url + "src/imagens/temp/" + data);
               //atualiza tambem o value do imagem antiga para nao deixar de deletar
               var imagemantiga = document.getElementById("imagemantiga");
               imagemantiga.value = data;
               imagemUpload.value = data;
               //Ligando o botao do form de cadastrar produto
               btnEnviar.disabled = false;
           } else {
               btnEnviar.disabled = true;
               $("#imagemproduto").attr("src", base_url + "src/imagens/pagina/perfil/harry-square.png");
            }
           
        },
        error: function(xhr, ajaxOptions, thrownError){
            //alert(xhr.status);
           // alert(thrownError);
            //alert(xhr.responseText);
            alert("Um erro inesperado ocorreu");
        }
        // o callback será no elemento com o id #visualizar 
        }).submit();
    } else {
        btnEnviar.disabled = true;
        $("#imagemproduto").attr("src", base_url + "src/imagens/pagina/perfil/harry-square.png");
        alert("Tipo de arquivo inválido");
    }
}