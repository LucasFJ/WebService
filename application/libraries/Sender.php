<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sender{
    
    public function __construct() {
        require_once 'mail/class.phpmailer.php';
        require_once 'mail/class.smtp.php';
        require_once 'mail/PHPMailerAutoload.php';
    }
    
    public $mail;   //Objeto que irá instanciar a classe PHPmailer
    //public $email = "suporte@sniffoo.com.br";  //Email utilizado pelo remetente 
    public $email = "suporte.sniffoo@gmail.com";  //Email utilizado pelo remetente
    public $nome =  "Sniffoo"; //Nome utilizado pelo remetente
    public $senha = "dli01121920"; //Senha para acessar o email do remetente
    //public $host = "smtp.sniffoo.com.br"; //Host responsável por enviar o email
    public $host = "tls://smtp.gmail.com:587"; //Host responsável por enviar o email
    
    public $header_mensagem = " header <br/>"; //INSIRA AQUI O HTML QUE SERÁ EXIBIDO NO HEADER
    public $footer_mensagem = " footer <br/>"; //INSIRA AQUI O HTML QUE SERÁ EXIBIDO NO FOOTER
    
    
    //FUNÇÃO: ARRUMA A MENSAGE PRINCIPAL PARA CONTER O LINK DE VALIDAÇÃO DE CONTA
    public function Validacao($nome_dest = false, $email_dest = false, 
            $codigo_processo = false, $codigo_chave = false){
        
        if($nome_dest && $email_dest && $codigo_chave && $codigo_processo){    
            $assunto = "Sniffoo - Verificação de e-mail";
            $url = base_url("processos/verificacao/$codigo_processo/$codigo_chave");
            $mensagem_principal =  "Olá $nome_dest, uma conta foi criada no sistema Sniffoo utilizando esse email."
                    . " Para realizar a verificação de sua conta e assim garantir um aproveitamento"
                    . " completo no sistema clique no link abaixo. <br/><br/>"
                    . "<a href='$url'>Clique aqui para verificar sua conta.</a> <br/><br/>";
            $mensagem = $mensagem_principal;
            $resultado = $this->Enviar($nome_dest, $email_dest, $assunto, $mensagem);
            if($resultado){
                return true;
            } else { //Ocorreu um erro durante o envio do e-mail
                return false;
            }
        }  else { //Algum dos parametros não foi enviado corretamente
         return false;   
        }
    }
    
    public function RecuperarSenha($nome_dest = false, $email_dest = false, 
            $codigo_processo = false, $codigo_chave = false){
        if($nome_dest && $email_dest && $codigo_chave && $codigo_processo){
            $assunto = "Sniffoo - Recuperação de senha";
            $url = base_url("processos/recuperacao/$codigo_processo/$codigo_chave");
            $mensagem_principal =  "Olá $nome_dest, um pedido de recuperação de senha foi efetuado utilizando esse e-mail."
                    . " Para realizar a recuperação de sua conta e assim garantir o acesso"
                    . " completo no sistema clique no link abaixo. <br/><br/>"
                    . "<a href='$url'>Clique aqui para recuperar sua senha.</a> <br/><br/>";
            $mensagem = $mensagem_principal;
            $resultado = $this->Enviar($nome_dest, $email_dest, $assunto, $mensagem);
            if($resultado){
                return true;
            } else { //Ocorreu um erro durante o envio do e-mail
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function Exclusao($nome_dest = false, $email_dest = false, 
            $codigo_processo = false, $codigo_chave = false){
        if($nome_dest && $email_dest && $codigo_chave && $codigo_processo){    
            $assunto = "Sniffoo - Excluir página";
            $url = base_url("processos/excluir/$codigo_processo/$codigo_chave");
            $mensagem_principal =  "Olá $nome_dest, um pedido para excluir a página que você é proprietário foi solicitado."
                    . " Para confirmar o processo e remover todos os dados pertinentes a ela do sistema "
                    . " clique no link abaixo e confirme ou cancele o pedido."
                    . " Páginas excluidas não podem ser recuperadas e todos os dados serão perdidos permanentementes <br/><br/>"
                    . "<a href='$url'>Clique aqui para excluir sua página.</a> <br/><br/>";
            $mensagem = $mensagem_principal;
            $resultado = $this->Enviar($nome_dest, $email_dest, $assunto, $mensagem);
            if($resultado){
                return true;
            } else { //Ocorreu um erro durante o envio do e-mail
                return false;
            }
        }  else { //Algum dos parametros não foi enviado corretamente
         return false;   
        }
    }
    
    
    public function Contato($nome = false, $assunto = false, $email = false, 
            $mensagem = false){
        if($nome && $assunto && $email && $mensagem){
            $assunto = "$assunto";
            $mensagem_principal =  "Nome: $nome. <br/>"
                    . "Assunto: $assunto. <br/>"
                    . "E-mail: $email. <br/>"
                    . "Mensagem: <br/> $mensagem";
            $nome_dest = "suporte@sniffoo.com.br";
            $email_dest = "suporte@sniffoo.com.br";
            $fromName = "Fale conosco";
            if($this->Enviar($nome_dest, $email_dest, $assunto, $mensagem_principal, $fromName)){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    //FUNÇÃO: ENVIAR UM EMAIL PARA A O USUARIO COM UM ASSUNTO E MENSAGEM
    private function Enviar($nome_dest = false, $email_dest = false, 
            $assunto = false, $mensagem = false, $fromName = false){
        $mail = new PHPMailer;
        //$mail->setLanguage('pt');
        $mail->addAddress($email_dest, $nome_dest);
        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = $this->email;
        $mail->Password = $this->senha;
        $mail->From = $this->email;
        if($fromName){
            $mail->FromName = $fromName;
        } else {
            $mail->FromName = $this->nome;
        }
        
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        //resolvendo erro de ssl3_get_server_certificate
        $mail->SMTPOptions = array('ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ));
        
        $mail->Subject  = $assunto; // Assunto da mensagem
        $mail->Body = $mensagem; // A mensagem em HTML
        $mail->AltBody = trim(strip_tags($mensagem)); // A mesma mensagem em texto puro
    
        $resultado = $mail->send();
        if($resultado){
            echo "<script> alert('E-mail enviado com sucesso'); </script>";
            $mail->ClearAllRecipients();
            return true;
        } else { //Medida provisória para quando há bugs no envio de e-mail
            echo "<script> alert('$mail->ErrorInfo'); </script>";
            //echo "<script> alert('$this->host | $this->email | $this->senha'); </script>";
            //echo "<script> alert('$mensagem'); </script>";
            $mail->ClearAllRecipients();
            return false;
        }
    }
}

/*
 * INFORMAÇÕES IMPORTANTES:
 *  A classe em questão tem apenas como obrigação enviar os e-mails
 * com os conteudos passados através dos parâmetros.
 *  A validação e integridade dos dados depende exclusivamente dos
 * models que a utiliza.
 * 
 * VARIÁVEIS PRESENTES NO EMAIL:
 *  Para duvidas consultar : http://www.tutsup.com/2014/07/14/phpmailer-email-smtp-php/
 * 
 * 
 
 */
