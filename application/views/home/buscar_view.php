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
        <form class="col s12" action="<?php echo base_url('home/POSTbuscar'); ?>" method="post">
            <div class="row formLine">
            <div class="input-field col l6 m6 s12 inputNome">
              <input maxlength="25" id="nome" placeholder="Nome da página" type="text" class="validate" name="nome">
              <label for="nome" class="active">Nome</label>
            </div>
            <div class="input-field col l6 m6 s12">
                <select  name="ramo"  id='container-ramo' required>
                    <?php echo $ramos; ?>
                </select>
            </div>
            </div>
            <!-- ROW ROW ROW -->
            <div class="right-align"><a href="#" id="btnAdicional">Aprimorar pesquisa</a></div>
            <div id="buscaAdicional">
            <div class="row formLine">
            <div class="input-field col l6 m6 s12">
                <select name="ordenacao" required>
                <option value="0" selected>Ordenação</option>
                <option value="1">Melhores avaliadas</option>
                <option value="2">Nome de A a Z</option>
                <option value="3">Nome de Z a A</option>
              </select>
            </div>
            <div class="input-field col l6 m6 s12">
                <select name="estado" id="container-estado" required onchange="CarregarBoxCidade();">
                <?php echo $estados; ?>
              </select>
            </div>
            </div>
            <!-- ROW ROW ROW -->
            <div class="row formLine">
            <div id="container-cidade" class="input-field col l6 m6 s12">
               
            </div>
            <div id="container-bairro" class="input-field col l6 m6 s12">
                
            </div>
            </div>
            </div>
            <!-- ROW ROW ROW --><br />
            <div class="row center-align rowBusca">
            
            <button class="btn btnBusca orange darken-2" type="submit"  name="Buscar" value="Enviar" id="buscar" >
                Buscar<i class="mdi-action-search right"></i>
            </button>
            <button class="btn btnBusca orange darken-2" type="reset" />
                Limpar<i class="mdi-action-delete right"></i>
            </button>
            
            </div>
        </form>
    </div>
    </div>

<script>
    window.onload = function(){
        
        // Inicializa o elemento Form Select do Materialize
        $('select').material_select();
        
        // Oculta e permite Exibir/Ocultar a busca aprimorada
        $('#buscaAdicional').hide();
        $('#btnAdicional').click(mostrarAdicional);
        function mostrarAdicional(){
                $('#buscaAdicional').toggle();
        }
    }
</script>