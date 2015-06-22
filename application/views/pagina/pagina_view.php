<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = " <?php echo $nome; ?>";
</script>
<?php 
        $contato = (is_numeric($telefone) && is_numeric($celular)) ? "$telefone | $celular" : false;
        if(!$contato){
            $contato = (is_numeric($telefone)) ? $telefone : $contato = (is_numeric($telefone)) ? $telefone : ((is_numeric($celular))  ? $celular  : "");
        }
?>
<!-- Conteúdo da View abaixo -->
<!--CARD SERVICO-->
<div class="conteudo">
<div class="card-panel <?php echo $cor; ?> darken-1 lighten-1 z-depth-1">
    <div class="row cardConteudo valign-wrapper">
    <div class="col s3 right-align cardImagem">
    <img src='<?php echo base_url("src/imagens/pagina/perfil/$imagem"); ?>' class="materialboxed circle imgServico z-depth-1"/>
    </div>
    <div class="col s9 center-align cardInfo">
        <div class="row  white-text left-align cardTopo">
            <span class="nomeServico"><?php echo $nome;?></span><br />
            <h6 class="sloganServico"><?php echo $slogan; ?></h6>
            <h6 class="enderecoServico"><?php echo "$bairro - $cidade / $uf"; ?></h6>
            <h6 class="enderecoServico"><span class='telefone'><?php echo "$telefone"; ?></span>  
                <?php 
                if(isset($celular))
                    {
                        echo "<span class='celular'>| $celular</span>";        
                    } 
                ?>
            </h6>
        </div>
        <div class="row cardRodape valign-wrapper">
        <div class="col s12 m12 l12">
        <!-- Testa (usuario já avaliou?)-->
        <!-- SIM -->
<!--        <div class="col s7 left-align valign-wrapper cardRate">
                <i class="mdi-action-star-rate white-text rateServico"></i>
                <i class="mdi-action-star-rate white-text rateServico"></i>
                <i class="mdi-action-star-rate white-text rateServico"></i>
                <i class="mdi-action-star-rate white-text rateServico"></i>
                <i class="mdi-action-star-rate black-text rateServico"></i> 
                <span id="nota" class="nota"><?php echo "4,3" . "&nbsp;" . "(1.786)"; ?></span>
        </div>-->
        <!-- NÃO -->
        <div class="col s4 left-align valign-wrapper cardRate">
            <a href="#modalAvaliar" class="modal-trigger white-text">Avaliar!</a>
        </div>
        <div class="col s5 right-align right cardBotoes">
            <a href="#modalInfo" class="modal-trigger btn-floating waves-effect waves-light <?php echo $cor; ?> darken-4 btnServico"><i class="mdi-action-info-outline"></i></a>
<!--            <a href="#modalCompartilhar" class="modal-trigger btn-floating waves-effect waves-light  <?php echo $cor; ?> darken-4 btnServico"><i class="mdi-social-share valign-wrapper iconeBotao"></i></a>
            <a href="tel:<?php echo $telefone; ?>" class="hide-on-med-and-up btn-floating waves-effect waves-light  <?php echo $cor; ?> darken-4 btnServico"><i class="mdi-communication-call valign-wrapper iconeBotao"></i></a>-->
        </div>
        </div>
        </div>
    </div>
    </div>
</div>
        <?php 
            $address = "$logradouro+$numero,$bairro,$cidade,$uf,brasil";
            $address = strtolower($address);
            $address = urlencode($address);
            $address = str_replace(" ", "+", $address);
            //$address = "Alameda+Dois+215,Parque+Continental,Sao+Vicente,Brasil";
            $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');

            $output= json_decode($geocode);

            $lat = $output->results[0]->geometry->location->lat;
            $long = $output->results[0]->geometry->location->lng;
        ?>
    <style type="text/css"> 
        .tabs .indicator{
            background-color: <?php echo "$cor_hexa"; ?>;
        }
    </style>
        <ul class="tabs">
        <li class="tab"><a class="active <?php echo "$cor"; ?>-text" href="#produtos">Produtos</a></li>
        <li class="tab"><a class="<?php echo "$cor"; ?>-text" href="#localizacao" onclick="setTimeout(function (){google.maps.event.trigger(map, 'resize')}, 2000);">Localização</a></li>
        <li class="tab"><a class="<?php echo "$cor"; ?>-text" href="#comentarios">Comentários</a></li>
      </ul>

    <div id="produtos">
    
        <div class="contProdutos">
        <div class="row">
        <!-- PRODUTO 
            <div class="col s12 m4 l4">
            <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="<?php //echo base_url('src/imagens/pagina/produto/ECG.png'); ?>">
            </div>
            <div class="card-content cardContProduto">
                <span class="card-title activator grey-text text-darken-4"><h6 class="truncate">Interpretação de Eletrocardiograma</h6><i class="mdi-navigation-more-vert right"></i></span>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Interpretação de Eletrocardiograma<i class="mdi-navigation-close right"></i></span>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.</p>
            </div>
            </div>
                <a href="#modalExcluir" class="btn modal-trigger red lighten-1 waves-effect waves-light white-text btn-excluir-produto">Excluir Produto</a>
            </div>-->

        <?php
        if(is_array($produtos)){
            foreach($produtos as $value){
            echo    '<div class="col s12 m4 l4"><div class="card">'
                   .'<div class="card-image waves-effect waves-block waves-light">'
                   .'<img class="activator" src="'. base_url("src/imagens/pagina/produto/" . $value['imagem']) .'"></div>'
                   .'<div class="card-content cardContProduto">'
                   .'<span class="card-title activator grey-text text-darken-4"><h6 class="truncate">'. $value['nome'] .'</h6><i class="mdi-navigation-more-vert right"></i></span></div>'
                   .'<div class="card-reveal">'
                   .'<span class="card-title grey-text text-darken-4">'.$value['nome'].'<i class="mdi-navigation-close right"></i></span>'
                   .'<p>'. nl2br($value['descricao']) .'</p></div></div>';
            if($proprietario){
                echo '<a href="'. base_url("pagina/deletarproduto/".$value['codigo']) .'" class="btn modal-trigger red lighten-1 waves-effect waves-light white-text btn-excluir-produto">Excluir Produto</a>';
            }
            echo '</div>';
            }
        }
        ?>

        </div>
            <?php 

            if($proprietario){
                echo "<div class='row right-align'><div class='container'>"
                    ."<a href='". base_url('pagina/criarproduto') ."' class='btn-floating btn-med waves-effect waves-light $cor darken-1'><i class='mdi-content-add'></i></a><br/>"
                    ."</div></div>";
            }
            ?>
        </div>
        </div>
    </div>

<div id="localizacao"><br/>
    <div class="container">
    <div class="row center-align">
    <div class="col s12">
        <span><?php echo "$logradouro $numero $complemento, $bairro, $cidade / $uf CEP: $cep"; ?></span><br/><br/>
        <!-- O mapa será apresentado aqui -->
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC58cXWKOECkK7cENYOkA7JpIv7T3WrYxo&amp;sensor=false"></script>
        <div id="mapa" class="col s12" style="height: 300px; width: 100%;"></div>
    </div>
    </div>
    </div>
</div>

<div id="comentarios"><br/>
<div class="container">
<!-- Formulário de Envio -->    
<div id="formcomentario">
<form>
<div class="row">
<div class="input-field col s10 m10 l10">
    <input maxlength="150" id="comentario" type="text" class="validate" placeholder="Conte-nos o que achou da <?php echo $nome; ?>?">
    <label for="comentario" class="active">Comentário</label>
</div>
<div class="input-field col s2 m2 l2 center-align">
    <a onclick="InserirComentario(<?php echo "$codigo"; ?>)" class="btn-floating btn-med <?php echo $cor; ?> darken-1"><i class="mdi-content-send"></i></a>
</div>
</div>
</form>
</div>
    <div id="meucomentario"></div>
    <div id="outroscomentarios"></div>
</div>
</div>

<!--MODAL INFORMAÇÕES-->
<div id="modalInfo" class="modal white center modal-fixed-footer">
    <div class="modal-content grey-text text-darken-4">
    <h4>Informações</h4>

    <div class="row">
    <div class="col s12 m6 l6 left-align">
        <h6>Nome</h6>
        <h6 class="grey-text"><?php echo $nome; ?></h6>
    </div>
    <div class="col s12 m6 l6 left-align">
        <h6>Slogan</h6>
        <h6 class="grey-text"><?php echo $slogan; ?></h6>
    </div>
    <div class="col s12 m6 l6 left-align">
        <h6>Ramo</h6>
        <h6 class="grey-text"><?php echo $ramo; ?></h6>
    </div>
    <div class="col s12 m6 l6 left-align">
        <h6>Contato</h6>
        <h6 class="grey-text"><span class="telefone"><?php echo "$telefone"; ?></span> <span class="celular"><?php echo "$celular"; ?></span></h6>
    </div>
    <div class="col s12 m6 l6 left-align">
        <h6>Site</h6>
        <h6 class="grey-textx"><a href="<?php echo $site; ?>"><?php echo $site; ?></a></h6>
    </div>
    <div class="col s12 m6 l6 left-align">
        <h6>Localidade</h6>
        <h6 class="grey-text"><?php echo "$logradouro $numero $complemento, $bairro, $cidade / $uf"; ?></h6>
    </div>
    <div class="col s12 left-align">
        <h6>Descrição</h6>
        <h6 class="grey-text"><?php echo nl2br(str_replace('\\n','<br/>',$descricao)); ?></h6>
    </div>
    </div>
    </div>
    <div class="modal-footer grey lighten-4">
        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Voltar</a>
    </div>
</div>

<!--MODAL COMPARTILHAR-->
<div id="modalCompartilhar" class="modal white center modal-fixed-footer">
    <div class="modal-content grey-text text-darken-4">
        <h4>Compartilhar</h4>
        <p class="center-align">Caixa de opções para compartilhamento.</p><div id="fb-root"></div>
        
        <div class="fb-share-button" data-href="<?php base_url('pagina/minhapagina'); ?>" data-layout="button"></div>
        <div
            class="fb-like"
            data-share="true"
            data-width="450"
            data-show-faces="true">
        </div>
    </div>
    <div class="modal-footer grey lighten-4">
        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Compartilhar</a>
    </div>				
</div>


<!--MODAL AVALIAR-->
<div id="modalAvaliar" class="modal white center modal-fixed-footer">
<form>
    <div class="modal-content grey-text text-darken-4">
    <h4 class="sapoha">Avaliar</h4><br/>
    <div class="container">
        
    <p class="center-align">Escolha uma nota para <strong><?php echo $nome; ?></strong></p><br/>
    <!-- Escolha da nota -->
    
        <select id="select-nota" onchange="alteraEstrela()">
        <option value="0" disabled selected>Selecione uma nota</option>
        <option value="1">Muito Ruim</option>
        <option value="2">Ruim</option>
        <option value="3">Médio</option>
        <option value="4">Bom</option>
        <option value="5">Muito Bom</option>
        </select>
    <!-- Estrelas -->
    <i class="mdi-action-star-rate estrela black-text rateServico"></i>
    <i class="mdi-action-star-rate estrela black-text rateServico"></i>
    <i class="mdi-action-star-rate estrela black-text rateServico"></i>
    <i class="mdi-action-star-rate estrela black-text rateServico"></i>
    <i class="mdi-action-star-rate estrela black-text rateServico"></i>
    </div>  
</div>
<div class="modal-footer grey lighten-4" style="margin:0px; padding: 0px;">
    <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Enviar Avaliação</a>
</div>
    
    </form>
</div>

<!--MODAL EXLUIR PRODUTO-->
<div id="modalExcluir" class="modal white center modal-fixed-footer">
    <div class="modal-content grey-text text-darken-4">
        <h4 class="sapoha">Excluir Produto</h4><br/><br/>
        <p class="center-align">Deseja realmente exluir o produto <strong><?php echo "Nome do Produto"; ?></strong>?</p><br/>
    </div>
    <div class="modal-footer grey lighten-4" style="margin:0px; padding: 0px;">
        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Cancelar</a>
        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Ok</a>
    </div>
</div>

<script>
    window.onload = function(){
        $('.modal-trigger').leanModal();        
        //Máscaras de formulários com jQuery Mask
        $('.telefone').mask('(00) 0000-0000');
        $('.celular').mask('(00) 00000-0000');
        $('#cep').mask('00000-000');
        
        //Range modifica estrelas no modalAvalia
        $('#rangeAvalia').change(function(){
            alteraEstrela();    
        });
        $('#rangeAvalia').click(function(){
            alteraEstrela();    
        });
        
        $('select').material_select();
        window.scrollTo(0,1);
        IniciarMapa(<?php echo "$lat,$long";?>);
        CarregarMeuComentario(<?php echo $codigo; ?>);
        CarregarComentarios(<?php echo $codigo; ?>);
    }
</script>
