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

                   Dev que testa
                                                                                
                       ~=   ?                                                   
                       ::++=?                                                   
                      ++?+=++I                                                  
                     =+++???.?                                                  
                    ,+++++++=?                                                  
                    ++????++??                                                  
                 :=+++?++?++??+                                                 
         ,+??+++++++++???+++?+++++++?++                                         
        +?+?++++??+++++++++++?+++++??+?+                                        
       +????++++++++++=++++++++++++?????                                        
       ???+++++++++++++++++?+++++++?????+               Dev que não testa
      +???+?+++?+?+++++?+?=++++++++?+???+                                       
      ++??+?+++++++++?++++=+???++++?????+                    =~~~:=             
     =+++??+++++++++??????++?++++++?+??++                   +===~~~,~           
     ++++++++:?++++???+?+++++++=+++++++++                   :~+??=~~~,          
     ++++++++  +++++++++++++++?+? +++?+++                   =~,??=~~~~~         
     +++?+++++  +++?+++++++++??+  +++++++                    +??+~~~~~~:~       
     ++++++++=  +=+++++?+?++?++?  +++++++                    ???+=+==~::~       
     ++++??+++  +++++?+?+?++++?+ =++++++=                    ????++=+~:~~:      
      ??+???+    ++++??++++?+?+  ++?+++?                     ++??+?+~~:~::      
       ?????+=   ++++++?+++++++  ~+???++                     =++++=~~~~~::      
        ?????+=  +++++++  +?+?+ =+?????                      +?~==+~~,::~,      
         ?????=: =??+??    +?+  ++????                    +==++:==+=~,::        
          ??+?+   =?++     =?=  =???+                       :=:++++~~,          
                  +?+=     ?++                           =+++     +~            
                   ??,     ??                                     =:            
                    +      ++                                     +~            
                                                                                
            Preciso garantir que meu teste                Testar é muito difícil
     funciona e não quebra outras funcionalidades               ಠ╭╮ಠ
                    ᕦ(ò_óˇ)ᕤ
                                                                                
EOD;



