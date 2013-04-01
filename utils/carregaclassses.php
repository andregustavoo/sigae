<?php

    //Utilitário para incluir automaticamente os arquivos
    if (!defined("BASE_PATH")) define('BASE_PATH', dirname (dirname (__FILE__))); 
        function carregaClasse($class) {
            $classe=  BASE_PATH .'/model/' . $class . '.php';
            //echo $_SERVER['DOCUMENT_ROOT'];
            
            if (file_exists($classe)){
                require $classe;
            }else{
               $classe=BASE_PATH.'/dao/' . $class . '.php';
               if (file_exists($classe)){
                   require $classe;
               }
            } 
       }
       spl_autoload_register('carregaClasse');

           

?>
