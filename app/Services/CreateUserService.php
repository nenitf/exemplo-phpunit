<?php

namespace App\Services;

use App\Providers\MailProvider\IMailProvider;
use App\Providers\HashProvider\IHashProvider;
use App\Models\User;

class CreateUserService {
    private $mailProvider;
    private $hashProvider;

    function __construct(IMailProvider $mailProvider, IHashProvider $hashProvider){
        $this->mailProvider = $mailProvider;
        $this->hashProvider = $hashProvider;
    }

    public function execute($name, $email, $password){
        // evitar static methods pois é mais dificild e testar...
        // $usersWithSameEmail = User::where('email', $email);
        $usersWithSameEmail = (new User)->where('email', $email);

        if(!empty($usersWithSameEmail)) {
            throw new \Exception('Email existente');
        }

        $hashedPassword = $this->hashProvider->generateHash($password);

        $user = new User();
        try {
            $user->name = $name;
            $user->email = $email;
            $user->password = $email;
            $user->save();
        } catch (\Exception $e) {
            throw new \Exception('Não foi possível salvar no banco');
        }

        try {
            $this->mailProvider->send($email, 'exemplo de subject', 'account created', [ 'name' => $name ]);
        } catch (\Exception $e) {
            throw new \Exception('Não foi possível enviar o email' . $e->getMessage());
        }

        return true;
    }
}
