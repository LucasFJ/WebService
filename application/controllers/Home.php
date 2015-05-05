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
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
            $this->load->view('home/buscar_view');
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

