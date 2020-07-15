<?php

namespace App\Services;

use App\Providers\MailProvider\IMailProvider;
use App\Providers\HashProvider\IHashProvider;
use App\Repositories\UsersRepository;
use App\Models\User;

class CreateUserService2 {
    private $mailProvider;
    private $hashProvider;
    private $usersRepository;

    function __construct(IMailProvider $mailProvider, IHashProvider $hashProvider, UsersRepository $usersRepository){
        $this->mailProvider = $mailProvider;
        $this->hashProvider = $hashProvider;
        $this->usersRepository = $usersRepository;
    }

    public function execute($name, $email, $password){
        $usersWithSameEmail = $this->usersRepository->where('email', $email);

        if(!empty($usersWithSameEmail)) {
            throw new \Exception('Email existente');
        }

        $hashedPassword = $this->hashProvider->generateHash($password);

        $user = new User();
        try {
            $user->name = $name;
            $user->email = $email;
            $user->password = $email;
            $this->usersRepository->save($user);
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
