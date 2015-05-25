<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Processos extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('processo_model', 'process');
    }
    
    //OBSERVAÇÃO: como apenas é possivel acessar o controller com os dois dados
    //e url corretos, a função index apenas irá redirecionar o usuário para a home
    public function index(){
        redirect('home');
    }
    
    public function verificacao($codigo_processo = false, $codigo_chave = false){
        if(is_numeric($codigo_processo)  && $codigo_chave){
            //Impedindo SQL injection
            $codigo_chave = html_escape($codigo_chave);
            $codigo_processo = html_escape($codigo_processo);
            $codigo_chave = addslashes($codigo_chave);
            $codigo_processo = addslashes($codigo_processo);
            
            $resultado = $this->process->RealizarVerificacao($codigo_processo, $codigo_chave);
            if($resultado) {
                echo "Conta verificada com sucesso, você já pode usufluir de todas"
                . " as funcionalidades do projeto!!";
            } else { //A validação não ocorreu
                echo "Não foi possivel realizar a verificação";
            }
        } else { // algum dos dois parametros nao foi enviado
            redirect('home');
        }
    }
}