<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
            $funcao=$daoClasse->localizarPorId(3);
            if ($funcao){
                $individuo=new Individuo();
                $individuo->setNome('Gustavo Gomes');
                //Precisamos recuperar o id da classe;
                $individuo->setClasse($funcao);
                $individuo->setCpf('123567');
                $individuo->setEmail('andre@mail.com');
                $individuo->setDataNascimento(('1987-08-02'));
                $individuo->setTelefone('9870-0987');
                $daoIndividuo=new DAOIndividuo();
                if ($daoIndividuo->gravar($individuo)){
                    echo 'Cadastro Gravado com sucesso';
                }else{
                    echo 'Erro Salvando individuo';
                }
            }else{
                echo 'Erro salvando classe';
            }
        ?>
    </body>
</html>
