<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Buscar";
</script>

<!-- Conteúdo da View abaixo -->
<br />  
        <div class="container">
        <h5 class="center-align grey-text text-darken-2">Preencha o formulário para buscar o que precisa!</h5>
        </div>
    <!-- Formulário de Busca -->
    <div class="container">
    <div class="row">
        <form class="col s12" action="<?php echo base_url('home/buscar'); ?>" method="post">
            <div class="row formLine">
            <div class="input-field col l6 m6 s12 inputNome">
              <input id="nome" type="text" class="validate" name="nome" onclick="CarregarBoxRamo()">
              <label for="nome">Nome da página</label>
            </div>
            <div class="input-field col l6 m6 s12">
                <select  name="ramo"  id='container-ramo'>
                <option value="0" disabled selected>Ramo da página</option>
                 
              </select>
            </div>
            </div>
            <!-- ROW ROW ROW -->
            <div class="right-align"><a href="#" id="btnAdicional">Aprimorar pesquisa</a></div>
            <div id="buscaAdicional">
            <div class="row formLine">
            <div class="input-field col l6 m6 s12">
              <select name="ordenacao">
                <option value="0" disabled selected>Ordenação</option>
                <option value="1">Melhores avaliadas</option>
                <option value="2">Nome de A a Z</option>
                <option value="3">Nome de Z a A</option>
              </select>
            </div>
            <div class="input-field col l6 m6 s12">
                <select name="estado">
                <option value="0" disabled selected>Estado</option>
                <option value="1">São Paulo</option>
                <option value="2">Rio de Janeiro</option>
                <option value="3">Paraná</option>
                <option value="3">Rio Grande do Sul</option>
                <option value="3">Santa Catarina</option>
                <option value="3">Bahia</option>
              </select>
            </div>
            </div>
            <!-- ROW ROW ROW -->
            <div class="row formLine">
            <div class="input-field col l6 m6 s12">
                <select name="cidade">
                <option value="0" disabled selected>Cidade</option>
                <option value="1">Praia Grande</option>
                <option value="2">Santos</option>
                <option value="3">São Vicente</option>
              </select>
            </div>
            <div class="input-field col l6 m6 s12">
              <select name="bairro">
                <option value="0" disabled selected>Bairro</option>
                <option value="1">Cidade Ocian</option>
                <option value="2">Canto do Forte</option>
                <option value="3">Boqueirão</option>
              </select>
            </div>
            </div>
            </div>
            <!-- ROW ROW ROW --><br />
            <div class="row center-align rowBusca">
                    <input class="btn btnBusca orange darken-2" type="submit" name="Buscar" id="buscar" value="Buscar" />
                    <input class="btn btnBusca orange darken-2" type="reset" id="buscar" value="Limpar" />
            </div>
        </form>
    </div>
    </div>

<script>
    $(document).ready(function() {
        CarregarBoxRamo();
    });
</script>