<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <form method="post" action="<?php echo base_url('debug'); ?>">
    <div class="input-field">
        <input id="cep" name="cep" type="text" required />
        <label for="cep">Buscar CEP</label>
    </div>
    <button type="submit" value="Buscar"/>
    </form>
</div>