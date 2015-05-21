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
        <form class="col s12" action="<?php echo base_url('pagina'); ?>" method="post">
        <div class="card container">
            <!-- ROW ROW ROW -->
            <div class="row formLine">
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="nome" type="text" class="validate">
              <label for="nome">Nome da página</label>
            </div>
            <div class="input-field col l6 m6 s12">
              <select>
                <option value="" disabled selected>Ramo da página</option>
                <option value="1">Música e Arte</option>
                <option value="2">Jogos e Diversão</option>
              </select>
            </div>
            </div>
            <!-- ROW ROW ROW -->
            <div class="row formLine">
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="slogan" type="text" class="validate">
              <label for="slogan">Slogan</label>
            </div>
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="site" type="text" class="validate">
              <label for="site">Site</label>
            </div>
            </div>
            <!-- ROW ROW ROW -->
            <div class="row formLine">
            <div class="input-field col l12 m12 s12 inputNome">
              <textarea id="descricao" class="materialize-textarea" lenght="20"></textarea>
              <label for="descricao">Descrição</label>
            </div>
            </div>
        </div>
            <!-- ROW ROW ROW -->
            <div class="row formLine">
            <div class="input-field col l4 m4 s8 inputNome">
              <input id="cep" type="text" class="validate">
              <label for="cep">CEP</label>
            </div>
            <div class="input-field col l2 m2 s4 inputNome">
              <input id="numero" type="text" class="validate">
              <label for="numero">Número</label>
            </div>
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="complemento" type="text" class="validate">
              <label for="complemento">Complemento</label>
            </div>
            </div>
            <!-- ROW ROW ROW -->
            <div class="row formLine">
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="cidade" type="text" class="validate" disabled>
              <label for="cidade">Cidade</label>
            </div>
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="uf" type="text" class="validate" disabled>
              <label for="uf">UF</label>
            </div>
            </div>
            <!-- ROW ROW ROW --><br />
            <div class="row center-align rowBusca">
                    <input class="btn btnBusca orange darken-2" type="submit" id="buscar" value="Criar Página" />
                    <input class="btn btnBusca orange darken-2" type="reset" id="buscar" value="Limpar" />
            </div>
        </form>
    </div>