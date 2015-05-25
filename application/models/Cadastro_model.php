<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /*  FUNÇÂO: verificar se o usuário informou um email já cadastrado;
     *  Futuramente, com a implementação da biblioteca de EMAIL, o usuário
     *  receberá um e-mail informando um código que tem como finalidade ativar
     *  sua conta
     */
    public function cadastrarConta($email = null, $senha = null, $nome = null, 
            $sobrenome = null, $nascimento = null, $genero = null){
        
        if( $email != null && $senha != null && $nome != null && 
            $sobrenome != null && $nascimento != null && $genero != null){
            
            $disponivel = $this->disponibilidadeLogin($email);
            if($disponivel) {
               $nascimento = $this->validarData($nascimento);
               $senha = md5($senha); 
               $resultado_query1 = $this->db->query("insert into tb_usuario "
                       . "(nm_usuario, nm_sobrenome, nm_email, cd_senha, "
                        . " dt_cadastro, nm_ativo, dt_nascimento, nm_caminho_imagem,"
                       . " cd_genero) values "
                       . "('$nome', '$sobrenome', '$email', '$senha', now(), "
                        . "false, '$nascimento', null, $genero);");
               
                $resultado_query = $this->db->query ("SELECT cd_usuario FROM tb_usuario WHERE "
                       . " nm_email = '$email' LIMIT 1;");
               
               if($resultado_query->num_rows() > 0){
                   foreach($resultado_query->result() as $row){
                        $codigo_usuario = $row->cd_usuario;
                    }
                    /* EXECUTA A AÇÃO DE ENVIAR EMAIL DE VERIFICAÇÃO DE FORMA PASSIVA*/
                    $this->load->model('processo_model');
                    $this->processo_model->NovaVerificacao($codigo_usuario);
               }   
                    return true;
                
            } else { // o email informado ja esta sendo utilizado por outra conta
                return false;
            }
            
        } else { // há algum campo não preenchido;
            return false;
        }
        
    }
    
    public function disponibilidadeLogin($email = null){
        
        if($email){
            $resultado_query = $this->db->query("select nm_email from tb_usuario"
                    . " where nm_email = '$email' limit 1");
            if($resultado_query->num_rows() > 0){
                return false;
            } else { // nao há contas utilizando o email passado.
                return true;
            }
        } 
        return false;
    }
    
    public function validarData($data = null){
        if($data != null){
            //divide a string em 3 partes
            $data = trim($data);
            $data = explode( ' ', $data);
            //adquire o dia e o ano 
            $dia = $data[0];
            
            $ano = $data[2];
            //em seguida limpa a string de mês pois ainda está poluida e a
            //transforma em numeros
            $data2 = explode(',' ,$data[1]);
            switch($data2[0]){
                case 'Janeiro': $mes = '01'; break;
                case 'Fevereiro': $mes = '02'; break;
                case 'Março': $mes = '03'; break;
                case 'Abril': $mes = '04'; break;
                case 'Maio': $mes = '05'; break;
                case 'Junho': $mes = '06'; break;
                case 'Julho': $mes = '07'; break;
                case 'Agosto': $mes = '08'; break;
                case 'Setembro': $mes = '09'; break;
                case 'Outubro': $mes = '10'; break;
                case 'Novembro': $mes = '11'; break;
                case 'Dezembro': $mes = '12'; break;
            }
            
            return "$ano-$mes-$dia";
        } else {
            return false;
        }
    }
}
