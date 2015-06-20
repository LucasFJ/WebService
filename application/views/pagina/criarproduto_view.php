<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Criar Produto";
</script>

<!-- Conteúdo da View abaixo -->
<textarea class="materialize-textarea" style="display: none;"></textarea>
<br/>
<div class="container">
    <div class="center-align grey-text text-darken-3">
        <h5>Mantenha sua página sempre <strong>atualizada</strong>!</h5> 
        <span class="grey-text text-darken-1">Revise sempre seus produtos para melhores resultados!</span>
    </div>
    <br/>
    
<span class='red-text' id='erro'><?php echo $mensagem_erro;?></span><br/>
<div class="card grey lighten-4">
<div class="card-content contentForm center-align"><br/>  
    <!-- Exemplo Imagem -->
    <form id="formImagem" class="col s12" method="post" enctype="multipart/form-data">    
    <div class="row formLine">
    <div class="col s12 m4 l4 center-align cardImagem">
        <img id="imagemproduto" src="<?php echo base_url("src/imagens/default/default.png"); ?>" class="materialboxed imgServico z-depth-1"/>
    </div><br/><br/>
    <!-- Input Imagem -->
    <div class="file-field input-field left-align col s12 m8 l8">
        <input class="file-path validate" id="filepath" type="text" onchange="CarregarImagemProduto(<?php echo $codigo;?>);"/>
    <div class="btn grey darken-2">
        <span><i class="mdi-image-photo-camera"></i></span>
        <input type="hidden" name="MAX_FILE_SIZE" value="3900000" />
        <input type="hidden" id="imagemantiga" name="imagemantiga" value=""/>
        <input type="file" name="imgProduto"  required/>
    </div>
    </div>
    </div>
    </form>
        
    <!-- Input Nome -->
    <form id="formProduto" action="<?php echo base_url("pagina/POSTcriarproduto");?>" class="col s12" method="post">
    <div class="row formLine">
    <div class="input-field col l12 m12 s12 inputNome">
        <input maxlength="30" id="nmProduto" placeholder="Nome do produto" type="text" name="nmProduto" class="validate" required>
        <label for="nmProduto" class="active">Nome</label>
    </div>
    
    <!-- Input Descrição -->
    
    <div class="input-field col l12 m12 s12 inputNome">
        <textarea maxlength="200" id="descProduto" placeholder="Descrição do produto" name="descProduto" class="materialize-textarea" required></textarea>
        <label for="descProduto" class="active">Descrição</label>
        <input type="hidden" id="imagemUpload" name="imagemUpload" required/>
    </div>
    </div><br/>
    <!-- Botões -->
    <div class="row formLine">
    <div class="row center-align rowBusca">
        <input id="btnEnviar" class="btn btnBusca orange darken-2" type="submit" id="buscar" value="Cadastrar" name="CadastrarProduto"/>
        <input class="btn btnBusca orange darken-2" type="reset" id="buscar" value="Limpar" />
    </div>  
    </div> 
    </form>
</div>
</div>    
    
</div>