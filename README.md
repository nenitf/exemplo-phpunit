# exemplo-tdd

Exemplos simples de tdd, sendo as pastas:
- `app` o código do projeto
- `tests` os testes com phpunit

> Necessário possuir o [composer](https://getcomposer.org/)

```sh
# Instalação:
composer require


# Execução:
# No windows o composer remove todas cores do phpunit
# por isso existe o arquivo composer-test.php

# simples
composer test
#composer test tests/folder
#composer test tests/folder/ClasseTest.php
#composer test:group groupname
#composer test:group issue-number # marcado com @ticket


# com output testdox (criando frases a partir de camelCase)
composer test:dox
#composer test:dox tests/folder
#composer test:dox tests/folder/ClasseTest.php
#composer test:dox:group groupname
#composer test:dox:group issue-number # marcado com @ticket

# com log do resultado para um arquivo
composer test:log:html # cria em tests/_reports/testdox/phpunit-testdox.html
composer test:log:txt # cria em tests/_reports/testdox/phpunit-testdox.txt
composer test:log:xml # cria em tests/_reports/testdox/phpunit-testdox.xml

# com log para os testes de @group caso-de-uso
composer test:log:cdu:html # cria em tests/_reports/testdox/casos-de-uso.html
composer test:log:cdu:txt # cria em tests/_reports/testdox/casos-de-uso.txt
composer test:log:cdu:xml # cria em tests/_reports/testdox/casos-de-uso.xml

# com coverage para uma  função em PHP para poder ser tratado
composer test:coverage:php # cria em tests/_reports/CodeCoverage.php
```

## phpunit

### Configuração

Siga os passos abaixo em ordem, mas caso esteja iniciando um projeto utilize primeiramente ``composer init -q``.
1. Adicione dependência no `composer.json` com ``composer require phpunit/phpunit --dev``
2. Instale dependências do `composer.json` com ``composer install``
3. Configure `phpunit.xml`
4. Atualize autoload com ``composer du`` <!-- produção: ``compose du -o`` -->

### Criação de testes

1. Em `tests`, crie um arquivo que deve ter o mesmo nome da classe testada + ``Test.php``
2. Deve ser criada uma classe com o mesmo nome do arquivo extendendo ``PHPUnit\Framework\TestCase``
3. Escrever método(s) de teste (veja mais sobre em `dicas/Testes.md`) com o nome iniciando com ``test``

## Outros frameworks que poderiam ser estudados

* [phpuinit](http://www.phpunit.de)
* [kahlan](https://kahlan.github.io/docs/)
* [codeception](https://codeception.com/)
* [behat](https://docs.behat.org/en/latest/quick_start.html)
* [phpspec](http://www.phpspec.net/en/stable/)

<!-- vim: set nospell: -->
