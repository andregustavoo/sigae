<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title></title>
    </head>
    <?php
    //Utilitário para incluir automaticamente os arquivos
        function carregaClasse($class) {
            $classe=$_SERVER['DOCUMENT_ROOT'] .'/sigae/model/' . $class . '.php';
            if (file_exists($classe)){
                require $classe;
            }else{
               $classe=$_SERVER['DOCUMENT_ROOT'] .'/sigae/dao/' . $class . '.php';
               if (file_exists($classe)){
                   require $classe;
               }
            } 
       }
       spl_autoload_register('carregaClasse');

           
    ?>
    <body>
        <?php
            $daoClasse=new DAOFuncao();
           
        
                $funcao=new Classe();
                $funcao->setDescricao('blá,blá blá!');
                //Precisamos recuperar o id da classe;
               
                
                if ($daoClasse->gravar($funcao)){
                    echo 'Cadastro Salvo com sucesso';
                }else{
                    echo 'Erro Salvando classe';
                }
                 $funcao=$daoClasse->localizarPorId(3);
                 echo $funcao->getDescricao();
           
        ?>
    </body>
</html>
