<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<body>
    <!--<div id="fb-root"></div>-->

    
<header>
    <nav class="grey lighten-3">
    <div class="nav-wrapper container">
        <span id="cabecalho" class="brand-logo center orange-text text-darken-2"></span>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu orange-text"></i></a>
    </div>
    <ul id="nav-mobile" class="side-nav fixed">
        <li class="sideLogo bold orange-text text-darken-2 center">
            <img class="imgLogo valign-wrapper" src="<?php echo base_url('src/imagens/default/sniffoo-logo-min.png'); ?>"/>
        </li>
        <!-- Início -->
        <li><a href="<?php echo base_url('home/index'); ?>">Início</a></li>
        <!-- Buscar -->
        <li><a href="<?php echo base_url('home/buscar'); ?>">Buscar</a></li>
        <!-- Perfil -->
        <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li class="liMenu">
                <a class="collapsible-header waves-effect waves-orange aMenu"><strong>Perfil</strong></a>
            <div class="collapsible-body">
            <ul>
                <li><a href="<?php echo base_url('perfil/informacoes'); ?>">Informações</a></li>
            </ul>
            </div>
            </li>
        </ul>
        </li>
        <!-- Página -->
        <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li class="liMenu">
                <a class="collapsible-header waves-effect waves-orange aMenu"><strong>Página</strong></a>
            <div class="collapsible-body">
            <ul>
            <?php
                if($_SESSION['is_dono'] == true){
                    echo '<li><a href="'. base_url('pagina/minhapagina') .'">Minha página</a></li>';
                    echo '<li><a href="'. base_url('pagina/configuracoes') .'">Configurações</a></li>';
                }
                else {
                    echo '<li><a href="'. base_url('pagina/cadastrar') .'">Criar página</a></li>';  
                }
            ?>
            </ul>
            </div>
            </li>
        </ul>
        </li>
        <!-- Contato -->
        <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li class="liMenu">
                <a class="collapsible-header waves-effect waves-orange aMenu"><strong>Contato</strong></a>
            <div class="collapsible-body">
            <ul>
                <li><a href="<?php echo base_url('contato/sobrenos'); ?>">Sobre nós</a></li>
                <li><a href="<?php echo base_url('contato/faleconosco'); ?>">Fale conosco</a></li>
                <li><a href="<?php echo base_url('contato/termosdeuso'); ?>">Termos de uso</a></li>
            </ul>
            </div>
            </li>
        </ul>
        </li>
        <!-- Sair -->
        <li><a href="<?php echo base_url('home/sair'); ?>">Sair</a></li>
        </ul>
    </nav>
    </header>

    <main>