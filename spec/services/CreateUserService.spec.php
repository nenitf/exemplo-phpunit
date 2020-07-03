<?php

use App\Services\CreateUserService;
use App\Providers\HashProvider\BCryptProvider;
use App\Providers\MailProvider\MailerProvider;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

use Mockery as m;

describe("CreateUserService", function() {
    it("should create a new user", function() {
        $userTest = [
            'name' => 'Felipe',
            'email' => 'felipe.silva@mail.com',
            'password' => '123456'
        ];

        // dependência interna fixa
        $mockUser = m::mock('overload:App\Models\User');
        $mockUser->shouldReceive('where')
                 ->with('email', $userTest['email'])
                 ->andReturn(null);
        $mockUser->shouldReceive('save');

        $mockHashProvider = m::mock('App\Providers\HashProvider\IHashProvider');
        $mockHashProvider->shouldReceive('generateHash')
                         ->with($userTest['password'])
                         ->andReturn('hashedPassword');

        $mockMailProvider = m::mock('App\Providers\MailProvider\IMailProvider');
        $mockMailProvider->shouldReceive('send')
                         ->with($userTest['email'], 'exemplo de subject', 'account created', ['name' => $userTest['name']]);

        $service = new CreateUserService($mockMailProvider, $mockHashProvider);
        $newUser = $service->execute($userTest['name'], $userTest['email'], $userTest['password']);

        expect(true)->toBe($newUser);

        // fechar definição de overload
        m::close();
    });

    it("should not create a new user with duplicated email", function() {
        $userTest = [
            'name' => 'Felipe',
            'email' => 'felipe.silva@mail.com',
            'password' => '123456'
        ];

        // dependência interna fixa
        $mockUser = m::mock('overload:App\Models\User');
        $mockUser->shouldReceive('where')
                 ->with('email', $userTest['email'])
                 ->andReturn([
                     'name' => 'Eduardo',
                     'email' => 'felipe.silva@mail.com',
                 ]);

        // mocks inuteis pois o teste falha antes deles
        $mockHashProvider = m::mock('App\Providers\HashProvider\IHashProvider');
        $mockMailProvider = m::mock('App\Providers\MailProvider\IMailProvider');

        $service = new CreateUserService($mockMailProvider, $mockHashProvider);
        try {
            $newUser = $service->execute($userTest['name'], $userTest['email'], $userTest['password']);
        } catch (\Exception $e) {
            $emess = $e->getMessage();
            expect($emess)->toBe('Email existente');
        }

        // fechar definição de overload
        m::close();
    });
});

