<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Informações";
</script>

<!-- Conteúdo da View abaixo -->
<br/>
<div class="container">
<h6 class="center-align grey-text text-darken-2">Configurar uma imagem faz toda a diferença para a visualização de seu perfil.</h6><br/>
<span id="msgErro" class="red-text"><?php echo "$mensagem_erro";?></span><span id="msgSucesso" class="green-text"><?php echo "$mensagem_sucesso";?></span>
<ul class="collapsible" data-collapsible="accordion">
    
    <!-- Nome -->
    <li>
    <div class="collapsible-header active">
        <i class="mdi-social-person"></i>Nome <span id="erroNome" class="red-text"></span><span id="sucessoNome" class="green-text"></span>
    </div>
    <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <div class="input-field">
            <input maxlength="20" id="nome" type="text" value="<?php echo $nome;?>" required />
            <label for="nome" class="active">Nome</label>
        </div>
        <div class="input-field">
            <input maxlength="20" id="sobrenome" type="text" value="<?php echo $sobrenome;?>" required />
            <label for="sobrenome" class="active">Sobrenome</label>
        </div><br/>
        <div class="right-align">
            <a onclick="AlterarNomeUsuario();" class="btn btn-floating orange darken-2"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
    </div>
    </li>
    
    <!-- Imagem -->
    <li>
    <div class="collapsible-header">
        <i class="mdi-image-camera-alt"></i>Imagem <span id="erroImagem" class="red-text"></span><span id="sucessoImagem" class="green-text"></span>
    </div>
    <div class="collapsible-body container"><br/>
        <div class="col s12 center-align cardImagem"> 
            <?php
                $imagemantiga = $imagem;
                $imagem = (preg_match("/.png|.jpg$/i", $imagem)) ? base_url("src/imagens/usuario/$imagem") : "http://localhost/WebService/src/imagens/default/default.png";
            ?>
          <img id="imagem-usuario" src="<?php echo $imagem; ?>" class="circle imgServico z-depth-1"/>
        </div><br/>
        
        <form id="alterarimagem" action="<?php echo base_url("ajax/AlterarImagemUsuario")?>" class="col s12" method="post" enctype="multipart/form-data">
        <div class="file-field input-field left-align col s12">
            <input class="file-path validate" type="text" />
        <div class="btn grey darken-2">
            <span><i class="mdi-image-photo-camera"></i></span>
            <input type="hidden" name="MAX_FILE_SIZE" value="3900000" />
            <input type="hidden" id="imagemantiga" name="imagemantiga" value="<?php echo $imagemantiga; ?>">
            <input type="file" id="imagem" name="imagem" required/>
        </div>
        </div>
        <div class="right-align">
            <a onclick="AlterarImagemUsuario();" class="btn btn-floating orange darken-2"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
    </div>
    </li>
    
    <!-- E-mail -->
    <li>
    <div class="collapsible-header">
        <i class="mdi-content-mail"></i>E-mail <span id="erroEmail" class="red-text"></span><span id="sucessoEmail" class="green-text"></span>
    </div>
    <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="email" type="email" value="<?php echo $_SESSION['user_email']; ?>" required disabled />
            <label for="email" class="active">E-mail</label>
        </div><br/>
        <div class="center-align">
            <?php 
                if($ativo){
                    echo "<a id='btn-ativo' class='btn green'>Verificado <i class='mdi-action-done'></i></a>";
                } else {
                    echo "<a id='btn-ativo' class='btn red'>Não verificado</i></a><br/><a href='#' onclick='NovaVerificacao();'>Enviar novamente</a>";
                }
            ?>
        </div><br/>
        </form>
    </div>
    </li>
    
    <!-- Segurança -->
    <li>
    <div class="collapsible-header">
        <i class="mdi-action-lock"></i>Segurança 
    </div>
    <div class="collapsible-body container"><br/>
        <form action="<?php echo base_url("perfil/POSTalterarsenha");?>" class="col s12" method="post">
        <div class="input-field">
            <input type="hidden" name="codigoUsuario" value="<?php echo $codigo;?>"/>
            <input maxlength="40" name="senha-atual" id="senha-atual" type="password" placeholder="Digite sua senha atual" value="" required />
            <label for="senha-atual" class="active">Senha Atual</label>
        </div><br/>
        <div class="input-field">
            <input maxlength="40" id="senha-nova" name="senha-nova" type="password" placeholder="Digite sua nova senha" value="" required />
            <label for="senha-nova" class="active">Nova Senha</label>
        </div><br/>
        <div class="input-field">
            <input maxlength="40" id="senha-repete" name="senha-repete" type="password" placeholder="Repita sua nova senha" value="" required />
            <label for="senha-repete" class="active">Digite Novamente</label>
        </div><br/>
        <div class="right-align">
            <button type="submit" name="AlterarSenha" value="Enviar" class="btn btn-floating orange darken-2"><i class="mdi-navigation-check"></i></button>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
    </div>
    </li>
    
    <!-- Nascimento -->
    <li>
    <div class="collapsible-header">
        <i class="mdi-social-cake"></i>Nascimento <span id="erroNascimento" class="red-text"></span><span id="sucessoNascimento" class="green-text"></span>
    </div>
    <div class="collapsible-body container"><br/>
        <form class="col s12" method="post">
        <div class="input-field">
            <input id="data" type="date" value="<?php echo $data; ?>" class="datepicker"/>
        </div><br/>
        <div class="right-align">
            <a onclick="AlterarDataNascimento();" class="btn btn-floating orange darken-2"><i class="mdi-navigation-check"></i></a>
            <button class="btn btn-floating orange darken-2" type="reset"><i class="mdi-content-undo"></i></button>
        </div>
        </form>
    </div>
    </li>
    
</ul>

</div>

<script>
window.onload = function(){
    $('.datepicker').pickadate({
       selectMonths: true, // Creates a dropdown to control month
       selectYears: 15 // Creates a dropdown of 15 years to control year
     });
}
</script>