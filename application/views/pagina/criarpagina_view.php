<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Criar Página";
</script>

<!-- Conteúdo da View abaixo -->
<br />
    <div class="container">
        <h6 class="center-align grey-text text-darken-2">Ainda não tem uma <strong>Página</strong>?<br> Informe os dados do seu negócio que o <strong>Sniffoo</strong> faz o resto!</h6>
    </div>
<br />

<div class="container">    
<!-- Formulário de Cadastro de Página -->
<form class="col s12" method="post" enctype="multipart/form-data">
    <div class="card grey lighten-4">
    <div class="card-content contentForm center-align">
        <span class="card-title grey-text text-darken-2">Dados Principais </span>
        <!-- Nome e Ramo -->
        <div class="row formLine">
        <div class="input-field col l6 m6 s12 inputNome">
            <input id="nome" type="text" name="nome" class="validate" required>
            <label for="nome">Nome da página</label>
        </div>
        <div class="input-field col l6 m6 s12">
            <select name="ramo" required>
            <option value="" disabled selected>Ramo da página</option>
            <?php //echo $opcoes_ramo; 
                foreach($opcoes_ramo as $value){
                    echo "<option value='". $value['codigo'] ."'>". $value['ramo'] ."</option>";
                }
            ?>
            </select>
        </div>
        </div>
        <!-- Slogan e Site -->
        <div class="row formLine">
        <div class="input-field col l6 m6 s12 inputNome">
            <input id="slogan" type="text" name="slogan" class="validate" required>
            <label for="slogan">Slogan</label>
        </div>
        <div class="input-field col l6 m6 s12 inputNome">
            <input id="site" type="text" name="site" class="validate">
            <label for="site">Site</label>
        </div>
        </div>
        <!-- Descrição -->
        <div class="row formLine">
        <div class="input-field col l12 m12 s12 inputNome">
                <textarea id="descricao" name="descricao" class="materialize-textarea" required></textarea>
            <label for="descricao">Descrição</label>
        </div>
        </div>
        <!-- Telefones -->
        <div class="row formLine">
        <div class="input-field col l6 m6 s12 inputNome">
            <input id="telefone" type="text" name="telefone" class="validate telefone">
            <label for="telefone">Telefone</label>
        </div>
        <div class="input-field col l6 m6 s12 inputNome">
            <input id="celular" type="text" name="celular" class="validate celular">
            <label for="celular">Celular</label>
        </div>
        </div>
    </div>
    </div>
    <br />
    
    <div class="card grey lighten-4">
    <div class="card-content contentForm center-align">
    <span class="card-title grey-text text-darken-3">Imagem e Tema</span>
            <!-- Imagem e Cores -->
            <div class="row formLine">
            <div class="file-field input-field left-align col s12">
                <input class="file-path validate" type="text"/>
            <div class="btn grey darken-2">
                <span><i class="mdi-image-photo-camera"></i></span>
                <input type="file" name="imagem" />
            </div>
            </div>
            </div>
            <div class="row formLine center-align">
            <div class="input-field col l12 m12 s12">
                <select name="layout" required>
                <option value="" disabled selected>Selecione um layout</option>
                <?php 
                    foreach($opcoes_layout as $value){
                        echo "<option value='". $value['codigo'] ."'>". $value['cor_port'] ."</option>";
                    }
                ?>
                </select>
            </div>
            </div>
            <br/>
    </div>
    </div>
    <br />
    
    <div class="card grey lighten-4">
    <div class="card-content contentForm center-align">
        <span class="card-title grey-text text-darken-3">Localidade </span>
            <!-- CEP, Número e Complemento -->
            <div class="row formLine">
            <div class="input-field col l4 m4 s8 inputNome">
                <input id="codigo_logradouro" type="hidden" name="codigo_cep" value="">
                <input id="cep" type="text" name="cep" class="validate" value='' oninput="CarregarEndereco()" required>
                <label for="cep">CEP</label>
            </div>
            <div class="input-field col l2 m2 s4 inputNome">
              <input id="numero" type="text" name="numero" class="validate" value=''>
              <label for="numero">Número</label>
            </div>
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="complemento" type="text" name="complemento" class="validate" value=''>
              <label for="complemento">Complemento</label>
            </div>
        </div>
            <!-- Rua e Bairro -->
            <div class="row formLine">
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="rua" type="text" class="validate" disabled>
              <label for="rua" class="localidade">Rua</label>
            </div>
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="bairro" type="text" class="validate" disabled>
              <label for="bairro" class="localidade">Bairro</label>
            </div>
            </div>
            <!-- Cidade e Estado -->
            <div class="row formLine">
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="cidade" type="text" class="validate" disabled>
              <label for="cidade" class="localidade">Cidade</label>
            </div>
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="uf" type="text" class="validate" disabled>
              <label for="uf" class="localidade">UF</label>
            </div>
            </div>
    </div>
    </div>
    <br />
    
    <!-- Botões -->
    <div class="row center-align rowBusca">
        <input class="btn btnBusca orange darken-2" type="submit" id="buscar" value="Criar Página" name="Cadastrar"/>
        <input class="btn btnBusca orange darken-2" type="reset" id="buscar" value="Limpar" />
    </div>          
</form>
</div>