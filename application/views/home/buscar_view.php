<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Buscar";
</script>

<!-- Conteúdo da View abaixo -->

<!-- Formulário de Busca -->
    <div class="container">
    <div class="row">
        <form class="col s12">
            <div class="row">
            <div class="input-field col l6 m6 s12">
              <input id="nome" type="text" class="validate">
              <label for="nome">Nome da página</label>
            </div>
            <div class="input-field col l6 m6 s12">
              <select>
                <option value="" disabled selected>Ramo da página</option>
                <option value="1">Ramo nº1</option>
                <option value="2">Ramo nº2</option>
                <option value="3">Ramo nºN</option>
              </select>
            </div>
            </div>
            <!-- ROW ROW ROW -->
            <div class="row">
            <div class="input-field col l6 m6 s12">
              <select>
                <option value="" disabled selected>Estado</option>
                <option value="1">AC</option>
                <option value="2">AL</option>
                <option value="3">AP</option>
              </select>
            </div>
            <div class="input-field col l6 m6 s12">
              <select>
                <option value="" disabled selected>Cidade</option>
                <option value="1">Praia Grande</option>
                <option value="2">Santos</option>
                <option value="3">São Vicente</option>
              </select>
            </div>
            </div>
            <!-- ROW ROW ROW -->
            <div class="row">
            <div class="input-field col l6 m6 s12">
              <select size="2">
                <option value="" disabled selected>Bairro</option>
                <option value="1">Cidade Ocian</option>
                <option value="2">Canto do Forte</option>
                <option value="3">Boqueirão</option>
              </select>
            </div>
            <div class="input-field col l6 m6 s12">
              <select>
                <option value="" disabled selected>Ordenação</option>
                <option value="1">Melhores avaliadas</option>
                <option value="2">Nome de A a Z</option>
                <option value="3">Nome de Z a A</option>
              </select>
            </div>
            </div>
        </form>
    </div>
    </div>
<!-- ----------- -->

