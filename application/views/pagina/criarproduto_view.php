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
    
<form class="col s12" method="post" enctype="multipart/form-data">
<div class="card grey lighten-4">
<div class="card-content contentForm center-align"><br/>
    <!-- Exemplo Imagem -->
    <div class="row formLine">
    <div class="col s12 m4 l4 center-align cardImagem">
        <img src="<?php echo base_url("src/imagens/pagina/perfil/harry-square.png"); ?>" class="materialboxed imgServico z-depth-1"/>
    </div><br/><br/>
    <!-- Input Imagem -->
    <div class="file-field input-field left-align col s12 m8 l8">
        <input class="file-path validate" type="text"/>
    <div class="btn grey darken-2">
        <span><i class="mdi-image-photo-camera"></i></span>
        <input type="hidden" name="MAX_FILE_SIZE" value="3900000" />
        <input type="hidden" name="imgAntigaProduto" value="<?php //echo $imagem; ?>">
        <input type="file" name="imgProduto" required/>
    </div>
    </div>
    
    <!-- Input Nome -->
    <div class="input-field col l12 m12 s12 inputNome">
        <input id="nmProduto" placeholder="Nome do produto" type="text" name="nmProduto" class="validate" required>
        <label for="nmProduto" class="active">Nome</label>
    </div>
    </div>
    <!-- Input Descrição -->
    <div class="row formLine">
    <div class="input-field col l12 m12 s12 inputNome">
        <textarea id="descProduto" placeholder="Descrição do produto" name="descProduto" class="materialize-textarea" required></textarea>
        <label for="descProduto" class="active">Descrição</label>
    </div>
    </div><br/>
    <!-- Botões -->
    <div class="row formLine">
    <div class="row center-align rowBusca">
        <input class="btn btnBusca orange darken-2" type="submit" id="buscar" value="Cadastrar" name="Cadastrar"/>
        <input class="btn btnBusca orange darken-2" type="reset" id="buscar" value="Limpar" />
    </div>  
    </div>  
</div>
</div>    
</form>
    
</div>