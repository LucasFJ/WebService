 <?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('login');
        }
    }
    
    public function index(){    
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
            $this->load->view('home/inicio_view');
        $this->load->view('include/footer_view');
    }
    
    public function buscar(){
        $this->load->library('form_validation'); //Validar formularios
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        if(isset($_POST['Buscar'])){
            //inicia as regras de validação
            $this->form_validation->set_rules('nome', 'nome', 'alpha_numeric_spaces');
            $this->form_validation->set_rules('ramo', 'ramo', 'is_natural|required');
            $this->form_validation->set_rules('ordenacao', 'ordenação', 'is_natural|required');
            $this->form_validation->set_rules('estado', 'estado', 'is_natural|required');
            $this->form_validation->set_rules('cidade', 'cidade', 'is_natural|required');
            $this->form_validation->set_rules('bairro', 'bairro', 'is_natural|required');
            
            if($this->form_validation->run()){
                $acao = "CarregarCartoes(" . $_POST['ramo'] . "," . $_POST['estado'] . "," . 
                        $_POST['cidade'] . "," . $_POST['bairro'] . "," . $_POST['ordenacao'] . ",'" . $_POST['nome'] . "')";
                $dados = array('acao' => $acao);
                $this->load->view('home/inicio_view', $dados);
            } else { //Os dados não passaram pela validação
                $this->load->view('home/buscar_view');
            }
        } else { // A ação de busca ainda não ocorreu
            $this->load->view('home/buscar_view');
        }
        $this->load->view('include/footer_view');
    }
    
    public function favoritos(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
            $this->load->view('home/favoritos_view');
        $this->load->view('include/footer_view');
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