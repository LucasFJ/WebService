<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function CarregarDadosUsuario(){
        $email = $_SESSION['user_email'];
        $senha = $_SESSION['user_senha'];
        $resultado_query = $this->db->query("SELECT cd_usuario as 'codigo', "
                . " nm_usuario as 'nome', nm_sobrenome as 'sobrenome', nm_email as 'email',"
                . " nm_ativo, dt_nascimento as 'data', nm_caminho_imagem as 'imagem',"
                . " cd_genero as 'genero' FROM tb_usuario WHERE nm_email = '$email' AND "
                . " cd_senha = '$senha';");
        if($resultado_query->num_rows() > 0){
            $dados_usuario = array();
            foreach($resultado_query->result() as $row){
                $dados_usuario['codigo'] = $row->codigo;
                $dados_usuario['nome'] = $row->nome;
                $dados_usuario['sobrenome'] = $row->sobrenome;
                $dados_usuario['email'] = $row->email;
                $dados_usuario['ativo'] = $row->nm_ativo;
                $dados_usuario['data'] = $this->ConverterDataNascimento($row->data);
                $dados_usuario['imagem'] = (file_exists("src/imagens/usuario/" + $row->imagem)) ?
                base_url("src/imagens/usuario/" . $row->imagem) : base_url("src/imagens/default/default.png");
                $dados_usuario['genero'] = $row->genero;
            }
            
            return $dados_usuario;
        } else {
            return false;
        }
    }

    private function ConverterDataNascimento($data = false){
        if($data){
            $data2 = explode("-", $data);
            $ano = $data2[0];
            switch($data2[1]){
                case '01': $mes = 'Janeiro'; break;
                case '02': $mes = 'Fevereiro'; break;
                case '03': $mes = 'Março'; break;
                case '04': $mes = 'Abril'; break;
                case '05': $mes = 'Maio'; break;
                case '06': $mes = 'Junho'; break;
                case '07': $mes = 'Julho'; break;
                case '08': $mes = 'Agosto'; break;
                case '09': $mes = 'Setembro'; break;
                case '10': $mes = 'Outubro'; break;
                case '11': $mes = 'Novembro'; break;
                case '12': $mes = 'Dezembro'; break;
            }
            $dia = $data2[2];
            return "$dia $mes, $ano";
        } else {
            return false;
        }
    }
    
    private function validarData($data = null){
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
    
    public function AlterarNome($codigoUsuario = false, $novoNome = false){
        if(is_numeric($codigoUsuario) && $novoNome){
            $novoNome = explode("|", urldecode($novoNome));
            $nome = $novoNome[0];
            $sobrenome = $novoNome[1];
            $resultado_query = $this->db->query("UPDATE tb_usuario SET"
                    . " nm_usuario = '$nome', nm_sobrenome = '$sobrenome' "
                    . " WHERE cd_usuario = $codigoUsuario;");
            if($resultado_query){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function AlterarDataNascimento($codigoUsuario = false, $novaData){
        $novaData = urldecode($novaData);
        if(is_numeric($codigoUsuario) && preg_match("/^[,A-Za-zà-úÀ-Ú\s0-9]{10,30}$/i", $novaData)){
            $novaData = $this->validarData($novaData);
            if($novaData){
                $resultado_query = $this->db->query("UPDATE tb_usuario SET"
                    . " dt_nascimento = '$novaData' "
                    . " WHERE cd_usuario = $codigoUsuario;");
                if($resultado_query){
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function AlterarSenha($codigoUsuario = false, $senhaAntiga = false, 
            $novaSenha = false){
        if(is_numeric($codigoUsuario) && $senhaAntiga && $novaSenha){
            $senhaAntiga = md5($senhaAntiga);
            $novaSenha = md5($novaSenha);
            $resultado_query = $this->db->query("SELECT cd_usuario FROM"
                    . " tb_usuario WHERE cd_usuario = $codigoUsuario"
                    . " AND cd_Senha = '$senhaAntiga';");
            if($resultado_query->num_rows() > 0){
            $resultado_query = $this->db->query("UPDATE tb_usuario "
                    . " SET cd_senha = '$novaSenha' WHERE cd_usuario = $codigoUsuario"
                    . " AND cd_Senha = '$senhaAntiga';");
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
}
