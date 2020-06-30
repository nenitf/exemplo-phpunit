<?php

// https://stackoverflow.com/questions/4923653/using-spy-object-in-phpunit

use App\Models\ExemploService;
use App\Models\MailerProvider;
use App\Models\Tabela;

use Mockery as m;

class ExemploServiceTest extends PHPUnit\Framework\TestCase {

    public function testExecute(){
        // builtin phpunit
        // $stub = $this->createMock(MailerProvider::class);
        // $stub->method('send')->willReturn('foo');

        $mockMailProvider = m::mock(MailerProvider::class);
        $mockMailProvider->shouldReceive('send')
             ->once()
             ->with('exemplo de subject');

        $mockTabela = m::spy('overload:App\Models\Tabela');
        $mockTabela->shouldReceive('findById')
                     ->once()
                     ->with(5)
                     ->andReturn('Tested!');

        $service = new ExemploService($mockMailProvider);
        $retorno = $service->execute(5);
        // $this->assertEquals($retorno, 'Tested!');
        m::close();
    }
}

