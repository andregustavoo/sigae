<?php
    
include '../utils/carregaclassses.php';
require '../utils/gerarXML.php';       
    ?>
<?php

    if (isset($_GET['consultar'])){
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"); 
        //Recupera dados da consulta
        $dao=new DAOGrupoAtividade();
        $registros=$dao->listarGrupoAtividades();
        echo gerarXMLGrid($registros);
    }else if(isset($_GET['form'])){
        $idgrupoatividade=0;
        $descricao="";
        if (isset($_GET['idgrupoatividade'])){
            $id=$_GET['idgrupoatividade'];
            $dao=new DAOGrupoAtividade();
            $grupo=$dao->localizarPorId($id);
            $descricao=$grupo->getDescricao();
        }
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
        echo("<items>");
        echo('<item type="fieldset" name="data" label="Grupo de Atividade" inputWidth="auto">');
        echo('<item type="hidden" name="id" value="'. $id . '"/>');
        echo('<item type="input" name="descricao" label="Descrição" value="'. $descricao .'" position="label-top"/>');
        echo('<item type="button" name="salvargrupoatividade" value="Salvar"/>');
        echo('</item>');
        echo("</items>");
    }else if(isset($_POST['descricao'])){
        $dao=new DAOGrupoAtividade();
        $grupoatividade=new GrupoAtividade();
        $grupoatividade->setId($_POST['id']);
        $grupoatividade->setDescricao($_POST['descricao']);
        if($dao->gravar($grupoatividade)){
            echo 'OK';
        }else{
            echo 'Erro Salvando Classe';
        }
    }else if(isset($_POST['excluir'])){
        $id=$_POST['id'];
        $dao=new DAOGrupoAtividade();
        if ($dao->excluir($id)){
            echo 'OK';
        }else{
            echo 'Erro Excluindo Classe';
        }
    }

?>
