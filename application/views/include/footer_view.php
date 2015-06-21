<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    </main>
    
    <?php 
    $javascript = isset($javascript) ? $javascript : null;
    if(is_array($javascript)){
        echo "<script type='text/javascript' src='".base_url("src/js/jquery.js")."'></script>";
        echo "<script type='text/javascript' src='".base_url("src/js/jquery.mask.js")."'></script>";
        echo "<script type='text/javascript' src='".base_url("src/js/materialize.min.js")."'></script>";
        echo "<script type='text/javascript' src='".base_url("src/js/config.js")."'></script>";
        foreach($javascript as $src){
         echo "<script type='text/javascript' src=". base_url("src/js/$src") ."></script>";
        }
    } else {
        echo "<script type='text/javascript' src='". base_url('src/js/requisicoes-ajax.js') ."'></script>
    <script type='text/javascript' src='". base_url('src/js/jquery.js') ."'></script>
    <script type='text/javascript' src='". base_url('src/js/jquery.mask.js') ."'></script>
    <script type='text/javascript' src='". base_url('src/js/jquery.form.js') ."'></script>
    <script type='text/javascript' src='". base_url('src/js/materialize.min.js') ."'></script>
    <script type='text/javascript' src='". base_url('src/js/init.js') ."'></script>";
    }
    ?>
    
    
    <footer class="page-footer grey darken-1 center-align white-text">
        <a class="grey-text text-lighten-4" href="<?php echo base_url('contato/sobrenos') ?>">Sobre nós</a> |
        <a class="grey-text text-lighten-4" href="<?php echo base_url('contato/faleconosco') ?>">Fale Conosco</a> |
        <a class="grey-text text-lighten-4" href="<?php echo base_url('contato/termosdeuso') ?>">Termos de Uso</a>
    <div class="rodape footer-copyright grey darken-1 center-align">
    <div class="container">
        Todos direitos reservados à DLI Sistemas <?php echo date('Y'); ?>
    </div>
    </div>
    </footer>
</body>
</html>