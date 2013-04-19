<?php
 //Utilitário para incluir automaticamente os arquivos
    if (!defined("BASE_PATH")) define('BASE_PATH', dirname (dirname (__FILE__))); 
        function carregaAluno($aluno) {
            $=  BASE_PATH .'/model/' . $ . '.php';
            //echo $_SERVER['DOCUMENT_ROOT'];
            
            if (file_exists($aluno)){
                require $aluno;
            }else{
               $aluno=BASE_PATH.'/dao/' . $class . '.php';
               if (file_exists($aluno)){
                   require $aluno;
               }
            } 
       }
       spl_autoload_register('carregaAluno');

?>
