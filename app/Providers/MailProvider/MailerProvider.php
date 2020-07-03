<?php

namespace App\Providers\MailProvider;

class MailerProvider implements IMailProvider{
    function send($destinatarios, $titulo, $template, $vars){
        print_r("Email com o titulo {$titulo} enviado!");
    }
}

