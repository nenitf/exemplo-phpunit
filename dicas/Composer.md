# Dicas sobre Composer
![](imgs/composer.png)

- Para iniciar rapidamente um projeto use ``composer init -q``
- `vendor`, `composer.lock` e `.phpunit.result.cache` não são versionados.
- Para atualizar os namespaces é use o comando ``composer du``
- Para atualizar dependências do `composer.json` use `composer require <projeto>/<projeto>`
- Para instalar dependências do `composer.json` use ``composer install`` e em produção ``composer install --no-dev``
- O autoload do composer pode ser setado conforme exemplificado com o namespace ``App`` desse projeto em `compose.json`
- ``composer self-update`` atualiza o composer

## Linux
- instalar: 
```
sudo su
curl -s https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```
- desinstalar: ``sudo rm -f /usr/local/bin/composer``
