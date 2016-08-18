<?php

require_once("iEnvio.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/infraestrutura/conexao/conexaoConfig.php");

class Email implements IEnvio
{
    function Enviar($destinatario, $assunto, $mensagem)
    {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: $nome <$email>';
        
        $enviaremail = mail($destinatario, $assunto, $mensagem, $headers);

        if($enviaremail)
        {
            print("Email enviado");
        } 
        else 
        {
            print("Erro ao enviar email");
        }
    }
}

?>