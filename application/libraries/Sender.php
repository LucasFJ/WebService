<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sender{
    
    public function __construct() {
        require_once 'mail/class.phpmailer.php';
    }
    
    public $mail;   //Objeto que irá instanciar a classe PHPmailer
    public $email = "suporte.sniffoo@gmail.com";  //Email utilizado pelo remetente 
    public $nome =  "DLI Sistemas"; //Nome utilizado pelo remetente
    public $senha = "dli01121920"; //Senha para acessar o email do remetente
    public $host = "smtp.gmail.com"; //Host responsável por enviar o email
    
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
            $mensagem = $this->header_mensagem + $mensagem_principal + $this->footer_mensagem;
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
    
    //FUNÇÃO: ENVIAR UM EMAIL PARA A O USUARIO COM UM ASSUNTO E MENSAGEM
    public function Enviar($nome_dest = false, $email_dest = false, 
            $assunto =false, $mensagem = false){
        
        $mail = new PHPMailer();
        $mail->addAddress($email_dest, $nome_dest);
        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Port = "465";
        $mail->Username = $this->email;
        $mail->Password = $this->senha;
        $mail->From = $this->email;
        $mail->FromName = $this->nome;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->Subject  = $assunto; // Assunto da mensagem
        $mail->Body = $mensagem; // A mensagem em HTML
        $mail->AltBody = trim(strip_tags($mensagem)); // A mesma mensagem em texto puro
    
        $resultado = $mail->send();
        if($resultado){
            $mail->ClearAllRecipients();
            return true;
        } else {
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
