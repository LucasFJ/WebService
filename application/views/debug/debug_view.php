<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <form method="post" action="<?php echo base_url('debug/index'); ?>">
    <div class="input-field">
        <input id="cep" name="cep" type="text" required />
        <label for="cep" id="teste">Buscar CEP</label>
    </div>
        <a type="btn" id="enviaCEP" class="btn">Buscar</a>
    </form>
    <br />
    <div class="card-panel center-align cian lighten-3">
        
        <div class="row container">
        <div class="input-field">
            <input type="text" id="rua" value="<?php echo $logradouro; ?>" />
            <label for="rua">Logradouro</label>
        </div>
        </div>
        <div class="row container">
        <div class="input-field">
            <input type="text" id="bairro" value="<?php echo $bairro; ?>" />
            <label for="rua">Bairro</label>
        </div>
        </div>
        <div class="row container">
        <div class="input-field">
            <input type="text" value="<?php echo $cidade; ?>" />
            <label for="rua">Cidade</label>
        </div>
        </div>
        <div class="row container">
        <div class="input-field">
            <input type="text" value="<?php echo $uf; ?>" />
            <label for="rua">UF</label>
        </div>
        </div>
    
    </div>
</div>