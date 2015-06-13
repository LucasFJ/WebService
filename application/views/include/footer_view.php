<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    </main>
    
    <script type="text/javascript" src="<?php echo base_url('src/js/requisicoes-ajax.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('src/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('src/js/jquery.mask.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('src/js/jquery.form.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('src/js/materialize.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('src/js/init.js'); ?>"></script>
    
    <?php 
        //foreach($javascript as $value){
         //echo "<script type='text/javascript' src=". base_url("src/js/$value") ."></script>";
        //}
    ?>
    
    <footer class="page-footer grey darken-1">
      <div class="rodape footer-copyright grey darken-1 center-align">
            Todos direitos reservados à DLI Sistemas <?php echo date('Y') ?>
      </div>
    </footer>

</body>
</html>