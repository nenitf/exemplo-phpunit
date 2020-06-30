<?php

namespace App\Models;

use App\Models\IMailProvider;

class MailerProvider implements IMailProvider{
    function send($titulo){
        print_r("Email com o titulo {$titulo} enviado!");
    }
}

