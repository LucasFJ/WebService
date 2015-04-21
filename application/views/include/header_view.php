<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<body>
  <header>
    <nav class="grey lighten-3">
      <div class="nav-wrapper">
        <span unselectable="on" class="brand-logo center orange-text text-darken-2">Service</span>
      </div>
      <?php
        if($possuiNav){
          $this->load->view('include/nav_view');
        }
      ?>
    </nav>
  </header>