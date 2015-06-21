 <?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('login');
        }
    }
    
    public function index(){
        $dados_footer = array('javascript' => array('busca_req.js'));
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
            $this->load->view('home/inicio_view');
        $this->load->view('include/footer_view', $dados_footer);
    }
    
    public function buscar($msgErro = " ", $acao = false){
        $this->load->library('form_validation'); //Validar formularios
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        //Verificando se ja foi efetuada a busca
        $acao = urldecode($acao);
        $regex = "/^CarregarCartoes[(]{1}[\d]{1,2},[\d]{1,2},[\d]{1,2},[\d]{1,2},[\d]{1,2},[ªº\.,'!?&+-A-Za-zá-úÁ=Ú\sàÀ0]{1,27}[)]{1}$/i";
        $dados_footer = array('javascript' => array('busca_req.js'));
        if(preg_match($regex, $acao)){
            $dados = array("acao" => $acao);
            $this->load->view('home/inicio_view', $dados);
            $this->load->view('include/footer_view', $dados_footer);
        } else {
            $this->load->model("ajax_model", "ajxmod");
            $dados = array("ramos" => $this->ajxmod->carregarOpcoesRamo(),
                "estados" => $this->ajxmod->carregarOpcoesEstado());
            $this->load->view('home/buscar_view', $dados);
            $this->load->view('include/footer_view', $dados_footer);
        }
        //$dados = array('acao' => $acao);
        //$this->load->view('home/inicio_view', $dados);

    }
    
    public function POSTbuscar(){
        if(isset($_POST["Buscar"])){
            $this->load->library("validacao");
            $nome =  trim($_POST['nome']);
            $ramo = $_POST['ramo'];
            $ordem = $_POST["ordenacao"];
            $estado = $_POST["estado"];
            $cidade = isset($_POST["cidade"]) ? $_POST["cidade"] : 0;
            $bairro = isset($_POST["bairro"]) ? $_POST["bairro"] : 0;
            if((!$this->validacao->ValidNomePagina($nome)) && (!empty($nome))){
                redirect("home/buscar/nomeinvalido");
            } else {
                $acao = urlencode("CarregarCartoes($ramo,$estado,$cidade,$bairro,$ordem,'$nome')");
                $acao = str_replace("+", "%20", $acao);
                redirect("home/buscar/clean/$acao");
            }
        } else{
            redirect("home/buscar");
        }      
    }

    public function Sair(){
        $this->status->fecharSessao();
        $this->status->fecharCookie();
        redirect('login');
    }
    
 
}

    /* OBSERVAÇÃO IMPORTANTE
     *  Tanto a tela de home quanto a de buscar tem a mesma finalidade em comum,
     * que no caso seria a de carregar os cartões para os usuários, contudo a home
     * possui uma regra fixa de carregar aquelas que se encontram no topo do 
     * ranking enquanto a de buscar os parâmetros são passados através de POST.
     * 
     */