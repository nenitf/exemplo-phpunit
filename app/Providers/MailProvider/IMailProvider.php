<?php

namespace App\Providers\MailProvider;

interface IMailProvider {
    function send($destinatarios, $titulo, $template, $vars);
}

