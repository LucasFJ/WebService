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
<span class='center-align red-text' id='erro'><?php echo $mensagem_erro;?></span><br/>
<!-- Formulário de Cadastro de Página -->
<form action="<?php echo base_url("pagina/POSTcadastrar");?>" class="col s12" method="post" enctype="multipart/form-data">
    <div class="card grey lighten-4">
    <div class="card-content contentForm center-align">
        <span class="card-title grey-text text-darken-2">Dados Principais </span>
        <!-- Nome e Ramo -->
        <div class="row formLine">
        <div class="input-field col l6 m6 s12 inputNome">
            <input maxlength="25" id="nome" placeholder="Nome da página" type="text" name="nome" class="validate" required>
            <label for="nome" class="active">Nome *</label>
        </div>
        <div class="input-field col l6 m6 s12">
            <select name="ramo" required>
            <option value="" disabled selected>Ramo da página *</option>
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
            <input maxlength="40" id="slogan" placeholder="Slogan da página" type="text" name="slogan" class="validate" required>
            <label for="slogan" class="active">Slogan *</label>
        </div>
        <div class="input-field col l6 m6 s12 inputNome">
            <input maxlength="50" id="site" placeholder="www.site.com.br" type="text" name="site" class="validate">
            <label for="site" class="active">Site</label>
        </div>
        </div>
        <!-- Descrição -->
        <div class="row formLine">
        <div class="input-field col l12 m12 s12 inputNome">
            <textarea maxlength="180" id="descricao" placeholder="Descrição da página" name="descricao" class="materialize-textarea" required></textarea>
            <label for="descricao" class="active">Descrição *</label>
        </div>
        </div>
        <!-- Telefones -->
        <div class="row formLine">
        <div class="input-field col l6 m6 s12 inputNome">
            <input maxlength="14" id="telefone" placeholder="(00) 0000-0000" type="text" name="telefone" class="validate telefone">
            <label for="telefone" class="active">Telefone</label>
        </div>
        <div class="input-field col l6 m6 s12 inputNome">
            <input maxlength="15" id="celular" placeholder="(00) 00000-0000" type="text" name="celular" class="validate celular">
            <label for="celular" class="active">Celular</label>
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
                <input type="file" name="imagem" required/>*
            </div>
            </div>
            </div>
            <div class="row formLine center-align">
            <div class="input-field col l12 m12 s12">
                <select name="layout" required>
                <option value="" disabled selected>Layout da página *</option>
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
                <input maxlength="9" id="cep" placeholder="00000-000" type="text" name="cep" class="validate" value='' oninput="CarregarEndereco()" required>
                <label for="cep" class="active">CEP *</label>
            </div>
            <div class="input-field col l2 m2 s4 inputNome">
                <input maxlength="7" id="numero" placeholder="0000" type="text" name="numero" class="validate" value=''>
              <label for="numero" class="active">Número</label>
            </div>
            <div class="input-field col l6 m6 s12 inputNome">
                <input maxlength="25" id="complemento" placeholder="Casa 00 / Apto 000" type="text" name="complemento" class="validate" value=''>
              <label for="complemento" class="active">Complemento</label>
            </div>
        </div>
            <!-- Rua e Bairro -->
            <div class="row formLine">
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="rua" type="text" class="validate" disabled required>
              <label class="active" for="rua" >Rua *</label>
            </div>
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="bairro" type="text" class="validate" disabled>
              <label class="active" for="bairro" >Bairro *</label>
            </div>
            </div>
            <!-- Cidade e Estado -->
            <div class="row formLine">
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="cidade" type="text" class="validate" disabled>
              <label class="active" for="cidade" >Cidade *</label>
            </div>
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="uf" type="text" class="validate" disabled>
              <label class="active" for="uf" >UF *</label>
            </div>
            </div>
    </div>
    </div>
    <br />
    
    <!-- Botões -->
    <div class="row center-align rowBusca">
        <input name="CriarPagina" class="btn btnBusca orange darken-2" type="submit" id="buscar" value="Criar Página" name="Cadastrar"/>
        <input class="btn btnBusca orange darken-2" type="reset" id="buscar" value="Limpar" />
    </div>          
</form>
</div>