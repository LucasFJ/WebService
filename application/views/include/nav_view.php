<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        <ul id="nav-mobile" class="side-nav fixed">
          <li class="sideLogo bold orange-text text-darken-2 center">SERVICE</li>
          <!-- Início -->
          <li><a href="#">Início</a></li>
          <!-- Buscar -->
          <li><a href="#">Buscar</a></li>
          <!-- Favoritos -->
          <li><a href="#">Favoritos</a></li>
          <!-- Perfil -->
          <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                        <li>
                          <a class="collapsible-header waves-effect waves-orange aMenu"><strong>Perfil</strong></a>
                          <div class="collapsible-body">
                                <ul>
                                  <li><a href="#">Informações</a></li>
                                  <li><a href="#">Privacidade</a></li>
                                  <li><a href="#">Configurações</a></li>
                                  <li><a href="#">Segurança</a></li>
                                  <li><a href="#">Excluir conta</a></li>
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
                                  <li><a href="#">Criar página</a></li>
                                  <li><a href="#">Editar página</a></li>
                                  <li><a href="#">Comentários</a></li>
                                  <li><a href="#">Excluir página</a></li>
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
                                  <li><a href="#">Fale conosco</a></li>
                                  <li><a href="#">Sobre nós</a></li>
                                  <li><a href="#">Sugestões</a></li>
                                  <li><a href="#">Termos de uso</a></li>
                                </ul>
                          </div>
                        </li>
                  </ul>
                </li>
          <!-- Sair -->
          <li><a href="<?php echo base_url('home/sair'); ?>">Sair</a></li>
        </ul>