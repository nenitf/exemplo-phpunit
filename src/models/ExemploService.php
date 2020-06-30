<?php

namespace App\Models;

use App\Models\IMailProvider;

class ExemploService {
    private $mailProvider;

    function __construct(IMailProvider $mailProvider){
        $this->mailProvider = $mailProvider;
    }

    public function execute($id){
        try {
            $this->mailProvider->send('exemplo de subject');
        } catch (\Exception $e) {
            throw new \Exception('Não foi possível enviar o email');
        }

        try {
            $tabela = new Tabela();
            return $tabela->findById($id);
        } catch (\Exception $e) {
            throw new \Exception('Não foi possível enviar o email');
        }

    }
}


