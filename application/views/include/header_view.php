<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<body>
<header>
  <nav class="grey lighten-3">
        <div class="nav-wrapper">
          <div class="container">
            <span unselectable="on" class="brand-logo center orange-text text-darken-2" id="topo"></span>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu orange-text"></i></a>
                </div>
        </div>
      
        <ul id="nav-mobile" class="side-nav fixed">
          <li class="sideLogo bold orange-text text-darken-2 center">SERVICE</li>
          <!-- Início -->
          <li><a href="login.php?link=nav/inicio">Início</a></li>
          <!-- Buscar -->
          <li><a href="login.php?link=nav/buscar">Buscar</a></li>
          <!-- Favoritos -->
          <li><a href="login.php?link=nav/favoritos">Favoritos</a></li>
          <!-- Perfil -->
          <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                        <li>
                          <a class="collapsible-header waves-effect waves-orange aMenu"><strong>Perfil</strong></a>
                          <div class="collapsible-body">
                                <ul>
                                  <li><a href="login.php?link=nav/informacoes">Informações</a></li>
                                  <li><a href="login.php?link=nav/privacidade">Privacidade</a></li>
                                  <li><a href="login.php?link=nav/configuracoes">Configurações</a></li>
                                  <li><a href="login.php?link=nav/seguranca">Segurança</a></li>
                                  <li><a href="login.php?link=nav/excluirconta">Excluir conta</a></li>
                                </ul>
                          </div>
                        </li>
                  </ul>
                </li>
          <!-- Página -->
          <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                        <li>
                          <a class="collapsible-header waves-effect waves-orange aMenu"><strong>Página</strong></a>
                          <div class="collapsible-body">
                                <ul>
                                  <li><a href="login.php?link=nav/criarpagina">Criar página</a></li>
                                  <li><a href="login.php?link=nav/editarpagina">Editar página</a></li>
                                  <li><a href="login.php?link=nav/comentarios">Comentários</a></li>
                                  <li><a href="login.php?link=nav/excluirpagina">Excluir página</a></li>
                                </ul>
                          </div>
                        </li>
                  </ul>
                </li>
          <!-- Contato -->
          <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                        <li>
                          <a class="collapsible-header waves-effect waves-orange aMenu"><strong>Contato</strong></a>
                          <div class="collapsible-body">
                                <ul>
                                  <li><a href="login.php?link=nav/faleconosco">Fale conosco</a></li>
                                  <li><a href="login.php?link=nav/sobrenos">Sobre nós</a></li>
                                  <li><a href="login.php?link=nav/sugestoes">Sugestões</a></li>
                                  <li><a href="login.php?link=nav/termos">Termos de uso</a></li>
                                </ul>
                          </div>
                        </li>
                  </ul>
                </li>
          <!-- Sair -->
          <li><a href="index.php">Sair</a></li>
        </ul>
  </nav>
</header>