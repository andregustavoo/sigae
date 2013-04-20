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
    if (!defined("BASE_PATH")) define('BASE_PATH', dirname (dirname (__FILE__))); 
        function carregaAluno($aluno) {
            $aluno=  BASE_PATH .'/model/' . $class . '.php';
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
    <body>
        <?php
        /*
         * Para testar o gravar, basta descomentar esse código e comentar o código abaixo
            $daoClasse=new DAOClasse();
            //Usar o ID equivalente ao aluno. O número pode variar de acordo com seu BD
            $classe=$daoClasse->localizarPorId(2);
            $aluno=new Aluno();
            $aluno->setNome('André Gustavo');
            $aluno->setClasse($classe);
            $aluno->setMatricula('201128900');
            $aluno->setCpf('090000');
            $aluno->setTelefone('9090-8990');
            $aluno->setDataNascimento("1984-08-20");
            $aluno->setEmail('bah@mail.com');
            $aluno->setTurma('20122INFO4V');
            //Cria um objeto da classe DAOAluno e realiza a inserção
            $daoAluno=new DAOAluno();
            
            if ($daoAluno->gravar($aluno)){
                echo 'Registro Inserido com Sucesso';
            }else{
                echo 'Falha na Inserção';
            }*/
        
            $daoAluno=new DAOAluno();
            $aluno=$daoAluno->localizarPorId(8);
            echo $aluno->getNome();
            $aluno->setNome('Roberto Fernandes');
            if($daoAluno->gravar($aluno)){
                echo 'Registro atualizado com sucesso';
            }else{
                echo 'Problema na atualização';
            }
        
        ?>
    </body>
</html>
