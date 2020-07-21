<?php

use App\Services\CreateUserService2;

/**
 * @testdox Criação do usuario
 */
class CreateUserService2Test extends PHPUnit\Framework\TestCase {
    /**
     * @group caso-de-uso
     * @ticket 150
     */
    public function testShouldCreateANewUser(){
        $userTest = [
            'name' => 'Felipe',
            'email' => 'felipe.silva@mail.com',
            'password' => '123456'
        ];

        $mockUsersRepository = $this->createMock(
            'App\Repositories\UsersRepository'
        );
        // espera que:
        //  - método exista
        //  - seja chamado uma vez
        //  - seja chamado com os parâmetros determinados
        $mockUsersRepository->expects($this->once())
                            ->method('where')
                            ->with('email', $userTest['email'])
                            ->willReturn(null);
        $mockUsersRepository->method('save');

        $mockHashProvider = $this->createMock(
            'App\Providers\HashProvider\IHashProvider'
        );
        $mockHashProvider->expects($this->once())
                         ->method('generateHash')
                         ->with($userTest['password'])
                         ->willReturn('hashedPassword');

        $mockMailProvider = $this->createMock(
            'App\Providers\MailProvider\IMailProvider'
        );
        $mockMailProvider->expects($this->once())
                         ->method('send')
                         ->with(
                             $userTest['email'],
                             'exemplo de subject',
                             'account created',
                             ['name' => $userTest['name']]
                         );

        $service = new CreateUserService2(
            $mockMailProvider, $mockHashProvider, $mockUsersRepository
        );
        $newUser = $service->execute(
            $userTest['name'], $userTest['email'], $userTest['password']
        );
    }

    /**
     * @group caso-de-uso
     * @ticket 150
     */
    public function testShouldNotCreateANewUserWithEmailDuplicated(){
        /** arrange */
        $userTest = [
            'name' => 'Felipe',
            'email' => 'felipe.silva@mail.com',
            'password' => '123456'
        ];

        /// mocks
        $mockUsersRepository = $this->createMock(
            'App\Repositories\UsersRepository'
        );
        $mockUsersRepository->method('where')
                            ->with('email', $userTest['email'])
                            ->willReturn([
                                'name' => 'Eduardo',
                                'email' => 'felipe.silva@mail.com',
                            ]);

        $mockHashProvider = $this->createMock(
            'App\Providers\HashProvider\IHashProvider'
        );
        $mockMailProvider = $this->createMock(
            'App\Providers\MailProvider\IMailProvider'
        );

        $service = new CreateUserService2(
            $mockMailProvider, $mockHashProvider, $mockUsersRepository
        );

        /** act */
        try {
            $newUser = $service->execute(
                $userTest['name'], $userTest['email'], $userTest['password']
            );
        } catch (Exception $e) {
            $emess = $e->getMessage();

            /** assert */
            $this->assertEquals($emess, 'Email existente');
        }
    }
}

