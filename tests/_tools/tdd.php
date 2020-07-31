<?php

unset($argv[0]);

// THANKS: https://stackoverflow.com/a/2929951/9881278
do {
    // system('cls');
    // chr(27);
    system('clear');
    if(empty($argv)){
        system('composer test');
    } else {
        system('composer test:'. join(' ', $argv));
    }
    $cmd = trim(strtolower( readline("\n> Enter para continuar ou q para sair: ") ));
    readline_add_history($cmd);
} while ($cmd!='q');

$testdoxFilename = 'tests/_reports/testdox/executed.txt';
system("composer test:cover -- --testdox-text {$testdoxFilename} --coverage-text");

$testdox = file_get_contents($testdoxFilename);

print <<<EOD

TESTDOX

$testdox

EOD;

print <<<EOD
                                             *_   _   _   _   _   _ *
                                     ^       | `_' `-' `_' `-' `_' `|       ^
                                     |       |                      |       |
 Agradeço por testar, pois graças    |  (*)  |_   _   _   _   _   _ |  \^/  |
 a você estamos mais seguros agora!  | _<">_ | `_' `-' `_' `-' `_' `| _(#)_ |
 Verifique o coverage completo em:  o+o \ / \O                      0/ \ / (=)
 tests/_reports/coverage/index.html  0'\ ^ /\/                      \/\ ^ /`0
                                       /_^_\ |                      | /_^_\
                                       || || |                      | || ||
                                       d|_|b_T______________________T_d|_|b

EOD;

