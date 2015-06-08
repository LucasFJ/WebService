<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Configurações";
</script>

<!-- Conteúdo da View abaixo -->
<textarea class="materialize-textarea" style="display: none;"></textarea>
<br/>
<div class="container">
    <h6 class="center-align">Configure suas informações de forma simples e rápida.</h6><br/>

    <ul class="collapsible" data-collapsible="accordion">
    <li>
    <div class="collapsible-header">
        <i class="mdi-maps-store-mall-directory"></i>Nome <span id="erroNome" class="red-text"></span><span id="sucessoNome" class="green-text"></span>
    </div>
    <div class="collapsible-body container">
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="nome" type="text" value="<?php echo $nome; ?>" required />
            <label for="nome">Nome</label>
        </div>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2"  onclick="AlterarNomePagina(<?php echo $codigo; ?>)"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
    </div>
    </li>
    <li>
    <div class="collapsible-header">
        <i class="mdi-image-camera-alt"></i>Imagem <span class="erroImagem red-text"></span>
    </div>
      <div class="collapsible-body container"><p><?php echo "IMAGEEEEMMM"; ?></p></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="mdi-action-assignment-ind"></i>Slogan <span id= "erroSlogan" class="red-text"></span><span id="sucessoSlogan" class="green-text"></span>
      </div>
      <div class="collapsible-body container">
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="slogan" type="text" class="validate" value="<?php echo $slogan; ?>" required />
            <label for="slogan">Slogan</label>
        </div>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2" onclick="AlterarSloganPagina(<?php echo $codigo; ?>)"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="mdi-file-folder-open"></i>Ramo <span class="erroRamo red-text"></span><span id="sucessoRamo" class="green-text"></span>
      </div>
      <div class="collapsible-body container">
        <form class="col s12" method="post">
        <div class="input-field">
            <select name="ramo" id="ramo" required>
            <?php 
            //<option value="" disabled selected> echo $ramo; </option>
            foreach($opcoes_ramo as $value){
                if($value['ramo'] == $ramo){
                    echo "<option value=". $value['codigo'] ." selected>". $value['ramo'] ."</option>";
                } else {
                    echo "<option value=". $value['codigo'] .">". $value['ramo'] ."</option>";
                }
            }
            ?>
            <!-- Aqui o php gera todas as <option ramo> e deixa como 'selected' como default a que está cadastrada na página -->
            </select>
        </div>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2" onclick="AlterarRamoPagina(<?php echo $codigo; ?>)"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="mdi-action-description"></i>Descrição <span id="erroDesc" class="red-text"></span><span id="sucessoDesc" class="green-text"></span>
      </div>
      <div class="collapsible-body container">
        <form class="col s12" method="post">
        <div class="input-field">
          <textarea id="descricao" class="materialize-textarea grey-text"><?php echo strip_tags($descricao); ?></textarea>
          <label for="descricao">Descriçao</label>
        </div>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2" onclick="AlterarDescricaoPagina(<?php echo $codigo; ?>)"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="mdi-communication-call"></i>Telefone <span class="erroTelefone red-text"></span>
      </div>
      <div class="collapsible-body container">
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="telefone" type="text" class="telefone" value="<?php echo $contato1; ?>" required />
            <label for="telefone" class="active">Telefone</label>
        </div>
        <div class="input-field">
            <input id="celular" type="text" class="telefone" value="<?php echo $contato2; ?>" required />
            <label for="celular" class="active">Celular</label>
        </div>
        <div class="right-align">
            <button class="btn btn-floating orange darken-2" type="submit"><i class="mdi-navigation-check"></i></button>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
      </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="mdi-social-public"></i>Site <span class="erroSite red-text"></span>
        </div>
        <div class="collapsible-body container">
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="site" type="text" value="<?php echo $site; ?>" required />
            <label for="site">Site</label>
        </div>
        <div class="right-align">
            <button class="btn btn-floating orange darken-2" type="submit"><i class="mdi-navigation-check"></i></button>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="mdi-maps-map"></i>Localidade <span class="erroLocal red-text"></span>
        </div>
        <div class="collapsible-body container">
        <form class="col s12" method="post">
        <!-- CEP, Número e Complemento -->
        <div class="row formLine">
        <div class="input-field col l4 m4 s8">
            <input id="codigo_logradouro" type="hidden" name="codigo_cep" value="">
            <input id="cep" type="text" value='<?php echo $cep; ?>' oninput="CarregarEndereco()">
            <label for="cep" class="active">CEP</label>
        </div>
        <div class="input-field col l2 m2 s4">
            <input id="numero" type="text" name="numero" value="<?php echo $numero; ?>">
            <label for="numero" class="active">Número</label>
        </div>
        <div class="input-field col l6 m6 s12">
            <input id="complemento" type="text" name="complemento" value='<?php echo $complemento; ?>'>
            <label for="complemento" class="active">Complemento</label>
        </div>
        </div>
        <!-- Rua e Bairro -->
        <div class="row formLine">
        <div class="input-field col l6 m6 s12">
            <input id="rua" type="text" value="<?php echo $logradouro; ?>" disabled>
            <label for="rua" class="active">Rua</label>
        </div>
        <div class="input-field col l6 m6 s12">
            <input id="bairro" type="text" value="<?php echo $bairro; ?>" disabled>
            <label for="bairro" class="active">Bairro</label>
        </div>
        </div>
        <!-- Cidade e Estado -->
        <div class="row formLine">
        <div class="input-field col l6 m6 s12">
            <input id="cidade" type="text" value="<?php echo $cidade; ?>" disabled>
            <label for="cidade" class="active">Cidade</label>
        </div>
        <div class="input-field col l6 m6 s12">
            <input id="uf" type="text" value="<?php echo $uf; ?>" disabled>
            <label for="uf" class="active">UF</label>
        </div>
        </div>
        <div class="right-align">
            <button class="btn btn-floating orange darken-2" type="submit"><i class="mdi-navigation-check"></i></button>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="mdi-image-color-lens"></i>Layout <span class="erroLayout red-text"></span></span><span id="sucessoLayout" class="green-text"></span>
        </div>
        <div class="collapsible-body container">
        <form class="col s12" method="post">
        <div class="input-field"> 
            <select name="layout" id="layout" required>
            <?php 
            //<option value="" disabled selected> echo $ramo; </option>
            foreach($opcoes_layout as $value){
                if($value['cor'] == $cor){
                    echo "<option value=". $value['codigo'] ." selected>". $value['cor_port'] ."</option>";
                } else {
                    echo "<option value=". $value['codigo'] .">". $value['cor_port'] ."</option>";
                }
            }
            ?>
            <!-- Aqui o php gera todas as <option ramo> e deixa como 'selected' como default a que está cadastrada na página -->
            </select>      
        </div>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2" onclick="AlterarLayoutPagina(<?php echo $codigo; ?>)"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
        </div>
    </li>
  </ul>
    <div class="row right-align">
        <h6><a href="#"><i class="mdi-action-delete tiny"></i> Excluir minha página</a></h6>
    </div>
</div>
