# exemplo-phpunit
Exemplo simples do phpunit, sendo as pastas:
- `src` o código do projeto
- `tests` os testes

## Instalação
O phpunit pode ser usado utilizando o gerenciador de dependências do [composer](https://getcomposer.org/), no qual precisa estar instalado para utilizar os comandos. Para testar a instalação digite ``composer`` no terminal.

## Configuração de um projeto com composer
Siga os passos abaixo em ordem, mas caso esteja iniciando um projeto utilize primeiramente ``composer init -q``.
1. Adicione dependência no `composer.json` com ``composer require phpunit/phpunit --dev``
2. Instale dependências do `composer.json` com ``composer install``
3. Atualize autoload com ``composer du`` <!-- produção: ``compose du -o`` -->

### Criação de testes
1. Em `tests`, crie um arquivo que deve ter o mesmo nome da classe testada + ``Test.php``
2. Deve ser criada uma classe com o mesmo nome do arquivo extendendo ``PHPUnit\Framework\TestCase``
3. Escrever método(s) de teste (veja mais sobre em `dicas/Testes.md`) com o nome iniciando com ``test``

## Execução dos testes
No arquivo `composer.json` existem scripts para executar os testes em ambiente linux ou windows sem precisar instalar o binário do [phpunit](https://phpunit.de/).
- Linux: ``composer ltest``
- Windows: ``composer wtest``

## Extensões interessantes
### Visual Studio Code
- [PHPUnit Test Explorer](https://marketplace.visualstudio.com/items?itemName=recca0120.vscode-phpunit)
- [PHPUnit](https://marketplace.visualstudio.com/items?itemName=emallin.phpunit)