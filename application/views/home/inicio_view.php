<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Início";
</script>
<!-- Conteúdo da View abaixo -->

 <!--CARD SERVICO-->
 <div id="container-cartoes">
        
 </div>
 <br/>
 <?php  $acao = isset($acao) ? $acao : "CarregarCartoes(0,0,0,0,0,0);"; ?>
 <div class="container right-align">
     <a class="btn-floating btn-med orange darken-2 waves-effect waves-light red fixed" onclick="<?php echo $acao;?>"><i class="mdi-content-add"></i></a>
 </div>
 
 <div class="container center-align">
 <br/><span id="msgErro" class="grey-text"></span>
 </div>
 
 <script>
    window.onload = function(){
         <?php echo $acao;?>
        //Máscaras de formulários com jQuery Mask
        $('.telefone').mask('(00) 0000-0000');
        $('.celular').mask('(00) 00000-0000');
        $('#cep').mask('00000-000');

    }
 </script>