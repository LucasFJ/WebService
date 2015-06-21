<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
document.getElementById("cabecalho").innerHTML = "Cadastro";
</script>

	<div class="no-pad-bot">
	<div class="container center">
	<br />
	<h5 class="center-align">Primeira vez por aqui? Preencha alguns campos para lembrarmos de você na próxima visita.</h5>
	<br />
        <span class='red-text' id='erro'><?php echo $mensagem_erro;?></span><br/>
            <!-- CARD LOGIN -->
            <div class="card center-align grey darken-2 z-depth-2">
                <br /><span class="card-title">Cadastro</span>
                <form action="<?php echo base_url("cadastro/POSTcadastro");?>" class="col s12" method="post">
            <div class="card-content center-align contForm">
                <!--FORM--->
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input maxlength="20" id="nome" name="nome" type="text" class="validate" required value=""/>
		  <label for="nome" class="inputLabel">Nome *</label>
		</div>
                <div class="input-field col l6 s12">
                    <input maxlength="20" id="sobrenome" name="sobrenome" type="text" class="validate" required  value=""/>
                <label for="last_name">Sobrenome *</label>
                </div>
                </div>
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input maxlength="50" id="email" name="email" type="email" class="validate" required value=""/>
                    <label for="first_name">E-mail *</label>
                </div>
                <div class="input-field col l6 s12 genero">
                  <select name="genero" required>
                    <option value="0" disabled selected>Gênero *</option>
                    <option value="1">Feminino</option>
                    <option value="2">Masculino</option>
                  </select>
                </div>
                </div>
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input maxlength="40" id="senha" name="senha" type="password" class="validate" required />
                <label for="first_name">Senha *</label>
                </div>
                <div class="input-field col l6 s12">
                    <input maxlength="40" id="repeteSenha" name="repeteSenha" type="password" class="validate" required />
                <label for="last_name">Senha Novamente *</label>
                </div>
                </div>
                
                <div class="row">
                <div class="input-field col l6 s12">
                    <input id="nascimento" name="nascimento" type="date" class="datepicker" required />
                <label for="first_name">Data de Nascimento *</label>
                </div>
                <div class="input-field col l6 s12">
                    <p>
                        <input name="concorda" type="checkbox" class="filled-in white" id="filled-in-box" required />
                        <label for="filled-in-box">Li e estou de acordo com os<span href="#modalTermos" class="blue-text modal-trigger"> Termos de Uso do Usuário </span>*</label>
                    </p><br/>
                </div>
                </div>
                <br />
                
                
                <!--/FORM-->
                
                <!-- BUTTONS -->
                <div class="container containerBtnCadastro">
                    <button name="CadastroUsuario" value="Enviar" type="submit" class="btnCadastro waves-effect waves-light white orange-text text-darken-4 btn tooltipped" data-position="top" data-delay="200" data-tooltip="Cadastrar-se">Cadastrar</button>
                    <button type="reset" class="btnCadastro waves-effect waves-light white orange-text text-darken-4 btn tooltipped" data-position="top" data-delay="200" data-tooltip="Limpar dados inseridos">Limpar</button>
                    </div>
                <!-- /BUTTONS -->
            </form>
            </div>
            <!-- /CARD LOGIN -->
	</div>
	<br /><br />
	</div>

<!--MODAL TERMOS DE USO -->
<div id="modalTermos" class="modal white center modal-fixed-footer">
    <div class="modal-content grey-text text-darken-4">
        <h4 class="sapoha">Termos de Uso</h4><br/><br/>
        <p align="justify">Agradecemos por usar nossos produtos e serviços. Os Serviços serão fornecidos 
            pela <strong>DLI Sistemas Ltda.</strong> <br/><br/>
            Ao usar nossos serviços, você estará concordando com estes termos. Leia-os com atenção. <br/><br/>
            Seguem palavras grafadas durante o documento que  terão o significado que a elas 
            é atribuído de acordo com o estabelecido abaixo: <br/><br/>
            &#9679; <strong>Usuário(s):</strong> são as pessoas físicas ou jurídicas que acessam 
            e usam os serviços providos pelo <strong>Sniffoo</strong>. <br/>
            &#9679; <strong>Site:</strong> conjunto de páginas ou lugar no ambiente da Internet 
            ocupado com conteúdo de uma empresa ou de uma pessoa. <br/>
            &#9679; <strong>Anunciante(s):</strong> são as empresas que veiculam seus anúncios ou 
            publicidade no <strong>Sniffoo</strong>. <br/>
            &#9679; <strong>Link(s):</strong> significa um acesso eletrônico, seja por meio de 
            imagens ou palavras, que permite a conexão a outras telas de um mesmo site, ou, ainda, 
            de outros sites. <br/>
            &#9679; <strong>Conteúdo:</strong> inclui texto, scripts, gráficos, fotos, imagens, 
            combinações audiovisuais, recursos interativos e outros materiais que o(s) usuário(s) 
            e o(s) anunciante(s), têm acesso ou submetem a um site. <br/><br/>
            O usuário(s) deve checar a veracidade das informações obtidas no site e tomar todas 
            as medidas necessárias para se proteger de danos, fraudes, inclusive "on-line" e "off-line".<br/><br/>
            O usuário(s) deve ler com atenção os termos antes de acessar ou usar o <strong>Sniffoo</strong>, 
            pois, o acesso ou uso deste implica em concordância integral com tais termos universais. <br/><br/>
            O <strong>Sniffoo</strong> captura e divulga anúncios advindos de diversos anunciantes, logo, 
            não atua como prestador de serviços de consultoria ou ainda intermediário ou participante em 
            nenhum negócio jurídico entre o usuário(s) e o(s) anunciante(s). <br/><br/>
            O <strong>Sniffoo</strong> oferece em seu site um mecanismo de busca personalizada por empresas 
            anunciadas através da Internet, a fim de selecionar as empresas que são previamente especificadas 
            pelo usuário como sendo de seu interesse a critério de comparação por avaliações feitas por 
            outros usuários. <br/><br/>
            Assim, não assumimos qualquer responsabilidade que advenha das relações existentes entre o 
            usuário(s) e o(s) anunciante(s), sejam elas diretas, e/ou também indiretas. <br/><br/>
            &#9679; Pelo conteúdo e funcionamento dos sites das empresas anunciantes; <br/>
            &#9679; Por negociações efetuadas entre usuário(s) e anunciante(s); <br/>
            &#9679; Por danos e/ou prejuízos resultantes das negociações, caso existam, entre usuário 
            e anunciante(s) cadastrados no site; <br/>
            &#9679; Se a caso a empresa anunciante possuir uma loja “on-line” e o usuário realizar transações 
            na Internet, que são de inteira e exclusiva responsabilidade de quem disponibilizar os respectivos 
            produtos ou serviços. <br/><br/>
            Assim, ressalta-se que qualquer tipo de negociação e/ou relação existente entre usuários e empresas 
            anunciantes, não é responsabilidade da <strong>DLI Sistemas Ltda.</strong>, uma vez que o propósito 
            do site <strong>Sniffoo</strong> é a divulgação. <br/>
            Portanto, a <strong>DLI Sistemas Ltda.</strong> não é responsável por qualquer ação ou omissão do 
            usuário(s) quanto as informações, anúncios, fotos ou outros materiais veiculados pelo 
            <strong>Sniffoo</strong>. <br/><br/>
            A <strong>DLI Sistemas Ltda.</strong> realizará seus melhores esforços para manter o site sempre atualizado, 
            completo e preciso, mas não se responsabilizará por erro, fraude, inexatidão, imprecisão ou divergência 
            nos dados,  fotos ou outros materiais relacionados a anúncios ou à inexatidão das informações contidas e 
            apresentadas no <strong>Sniffoo</strong>. O <strong>Sniffoo</strong> apresenta informações relacionadas a 
            empresas anunciantes, e os dados expostos, são de responsabilidade da mesma. <br/><br/>
            Eventuais erros no funcionamento do site serão corrigidos durante o período necessário para manutenção. 
            A <strong>DLI Sistemas Ltda.</strong> não se responsabiliza por danos decorrentes da não disponibilidade 
            ou erro de funcionamento do <strong>Sniffoo</strong>. <br/><br/>
            A <strong>DLI Sistemas Ltda.</strong>, seus funcionários, agentes, colaboradores, representantes e procuradores, 
            devem ser eximidos de toda e qualquer responsabilidade decorrente de qualquer tipo de reclamação ou ação 
            legal contra uma ou mais empresas anunciantes. <br/><br/>
            Caso o usuário(s) acesse o site de anunciante(s) e demais sites ou serviços que sejam acessados através 
            do <strong>Sniffoo</strong>, é possível que haja solicitação de informações financeiras e/ou pessoais do 
            usuário(s). Tais informações não serão enviadas pelo usuário(s) a <strong>DLI Sistemas Ltda.</strong>, e 
            sim diretamente ao solicitante, não tendo o site, portanto, não nos responsabilizamos por qualquer responsabilidade 
            pela utilização e manejo dessa informação. <br/><br/>
            Além disso, o usuário(s) e anunciante(s) não poderá(ão): <br/><br/>

            &#9679; Transmitir ou enviar informações de qualquer natureza que possam incitar induzir, ou promover 
            atitudes discriminatórias, mensagens violentas ou delituosas que atentem contra aos bons costumes, à moral 
            ou ainda que contrariem a ordem pública; <br/>
            &#9679; Cadastrar-se com informações de propriedade de terceiros ou falsas; <br/>
            &#9679; Alterar, apagar e/ou corromper dados e informações de terceiros; <br/>
            &#9679; Violar a privacidade de quaisquer usuário(s) e/ou anunciante(s); <br/>
            &#9679; Violar propriedade intelectual do site, de terceiros em geral, ou seja, direito autoral, marca, 
            patente, etc., através de reprodução, sem a prévia autorização do proprietário; <br/>
            &#9679; Usar "nome de usuário" que guarde semelhança com o nome "<strong>Sniffoo</strong>";<br/>
            &#9679; Transmitir ou enviar arquivos com vírus de computador, com conteúdo invasivo, destrutivo ou que 
            cause dano temporário ou permanente nos equipamentos do da <strong>DLI Sistemas Ltda.</strong>; <br/>
            &#9679; Utilizar nomes e/ou apelidos considerados ofensivos, bem como os que contenham dados pessoais de 
            qualquer usuário(s) e/ou anunciante(s); <br/>
            &#9679; Transmitir ou enviar informações de propriedade de terceiros; <br/>
            &#9679; Usar endereços de computadores, de rede ou de correio eletrônico falso; <br/>
            &#9679; Utilizar materiais que contenham qualquer vírus, worms, malware e outros programas de computador 
            que possa causar danos ao site ou ao usuário(s) ou anunciante(s) do <strong>Sniffoo</strong>; <br/>
            &#9679; Realizar a divulgação de materiais ilegais, agressivos, caluniosos, abusivos, difamatórios, 
            discriminatórios, ameaçadores, danosos, invasivos da privacidade de terceiros, terroristas, vulgares, 
            obscenos ou ainda condenáveis de qualquer; <br/><br/>
            O descumprimento às condições, termos e observações deste TERMO DE USO dá a <strong>DLI Sistemas Ltda.</strong> 
            o direito de cancelar, suspender, excluir e/ou desativar o cadastro do usuário(s), ou anunciante(s) temporária 
            ou definitivamente, ao seu único e exclusivo critério, sem prejuízo das cominações legais pertinentes e sem a 
            necessidade de comunicar aos mesmos da ação tomada dentro do seu sistema. <br/><br/>
            Caso exista alguma dúvida referente aos termos de uso do <strong>Sniffoo</strong>,  envie-nos um e-mail por meio 
            de: <a href="mailto:suporte@sniffoo.com.br">suporte@sniffoo.com.br</a><br/></p>
    </div>
    <div class="modal-footer grey lighten-4" style="margin:0px; padding: 0px;">
        <a class="waves-effect waves-green btn-flat modal-action modal-close">Voltar</a>
    </div>
</div>

            
<script>
    window.onload = function(){
        $('.modal-trigger').leanModal();  
        // Inicializa o elemento Form Select do Materialize
        $('select').material_select();
        
        // Inicialização de datas
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
           selectYears: 180 // Creates a dropdown of 15 years to control year
        });
    }
</script>