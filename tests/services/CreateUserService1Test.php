<?php

use App\Services\CreateUserService1;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

use Mockery as m;

/**
 * @testdox Criação do usuario com dependências internas
 */
class CreateUserService1Test extends PHPUnit\Framework\TestCase {
    use MockeryPHPUnitIntegration;

    /**
     * @group caso-de-uso
     * @todo Implementa x
     *
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * O Mockery afeta globalmente os testes (estático), portanto deve ser
     * rodados em um processo separado...
     * A anotação poderia ser evitada com processIsolation="true" no
     * phpunit.xml, porém rodar todos os testes em processos distintos afeta
     * performance
     */
    public function testShouldNotCreateANewUserWithEmailDuplicatedMockery(){
        // $this->markTestIncomplete('Mockery afeta outros testes além desse');
        // $this->markTestSkipped('Mockery afeta outros testes além desse');
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

        $service = new CreateUserService1($mockMailProvider, $mockHashProvider);

        try {
            $newUser = $service->execute($userTest['name'], $userTest['email'], $userTest['password']);
        } catch (Exception $e) {
            $emess = $e->getMessage();
            $this->assertEquals($emess, 'Email existente');
        }

        // fechar definição de overload
        m::close();
    }
    public function testUseless(){
    }
}

