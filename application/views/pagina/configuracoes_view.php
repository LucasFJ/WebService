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
    <div class="collapsible-body container"><br/>
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
        <i class="mdi-image-camera-alt"></i>Imagem <span id="erroImagem" class="red-text"></span><span id="sucessoImagem" class="green-text"></span>
    </div>
      <div class="collapsible-body container"><br/>
      <div class="col s12 center-align cardImagem"> 
          <img id="imagempagina" src="<?php echo base_url("src/imagens/pagina/perfil/$imagem"); ?>" class="circle imgServico z-depth-1"/>    
      </div><br/>
      <form id="alterarimagem" action="<?php echo base_url("ajax/AlterarImagemPagina/$codigo")?>" class="col s12" method="post" enctype="multipart/form-data">
        <div class="file-field input-field left-align col s12">
                <input class="file-path validate" type="text"/>
            <div class="btn grey darken-2">
                <span><i class="mdi-image-photo-camera"></i></span>
                <input type="hidden" name="MAX_FILE_SIZE" value="3900000" />
                <input type="hidden" id="imagemantiga" name="imagemantiga" value="<?php echo $imagem; ?>">
                <input type="file" id="imagem" name="imagem" required/>
            </div>
        </div>
        <div class="right-align">
            <a onclick=" AlterarImagemPagina(<?php echo $codigo; ?>)" class="btn btn-floating orange darken-2" ><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
      </form>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="mdi-action-assignment-ind"></i>Slogan <span id= "erroSlogan" class="red-text"></span><span id="sucessoSlogan" class="green-text"></span>
      </div>
      <div class="collapsible-body container"><br/>
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
      <div class="collapsible-body container"><br/>
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
      <div class="collapsible-body container"><br/>
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
      <div class="collapsible-header"><i class="mdi-communication-call"></i>Telefone <span id="erroTele" class="red-text"></span><span id="sucessoTele" class="green-text"></span>
      </div>
      <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="telefone" type="text" class="telefone" value="<?php echo $telefone; ?>" required />
            <label for="telefone" class="active">Telefone</label>
        </div>
        <div class="input-field">
            <input id="celular" type="text" class="celular" value="<?php echo $celular; ?>" required />
            <label for="celular" class="active">Celular</label>
        </div>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2" onclick="AlterarTelefonePagina(<?php echo $codigo; ?>)"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
      </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="mdi-social-public"></i>Site <span id="erroSite" class="red-text"></span><span id="sucessoSite" class="green-text"></span>
        </div>
        <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="site" type="url" value="<?php echo $site; ?>" required />
            <label for="site">Site</label>
        </div>
        <div class="right-align">
            <a class="btn btn-floating orange darken-2" onclick="AlterarSitePagina(<?php echo $codigo; ?>)"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="mdi-maps-map"></i>Localidade <span id="erroLocal" class="red-text"></span><span id="sucessoLocal" class="green-text"></span>
        </div>
        <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <!-- CEP, Número e Complemento -->
        <div class="row formLine">
        <div class="input-field col l4 m4 s8">
            <input id="codigo_logradouro" type="hidden" name="codigo_cep" value="<?php echo $codigo_logradouro; ?>">
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
            <a class="btn btn-floating orange darken-2" onclick="AlterarLocalidadePagina(<?php echo $codigo; ?>)"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="mdi-image-color-lens"></i>Layout <span class="erroLayout red-text"></span><span id="sucessoLayout" class="green-text"></span>
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
            <div class="center-align">
            <a class="btn red large"><i class="mdi-image-color-lens"></i></a><!-- Cor de exemplo dinâmico para Layout TO-DO -->
            </div>
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
        <span id="erroExcluir" class="red-text"></span><span id="sucessoExcluir" class="green-text"></span><h6><a href="#" onclick="ExcluirPagina(<?php echo $codigo; ?>);"><i class="mdi-action-delete tiny"></i> Excluir minha página</a></h6>
    </div>
</div>
