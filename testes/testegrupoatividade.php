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
            $funcao = new GrupoAtividade();
            $funcao->setDescricao('Testando');
            $daogrupoatividade = new DAOGrupoAtividade();
            if($daogrupoatividade->gravar($funcao)){
                echo 'Cadastro Gravado com Sucesso';
                }
                else{
                    echo 'Erro Salvando Grupo Atividade';
                }
            $localizar = $daogrupoatividade->localizarPorId(2);
            if($localizar){
                echo $localizar;
            }
            else{
                echo 'Erro salvando classe';
            }

        ?>
    </body>
</html>


