<?php
    
include '../utils/carregaclassses.php';
require '../utils/gerarXML.php';       
    ?>
<?php

    if (isset($_GET['consultar'])){
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"); 
        //Recupera dados da consulta
        $dao=new DAOFuncao();
        $registros=$dao->listarClasses();
        echo gerarXMLGrid($registros);
    }else if(isset($_GET['form'])){
        $idfuncao=0;
        $descricao="";
        if (isset($_GET['idclasse'])){
            $idfuncao=$_GET['idclasse'];
            $dao=new DAOFuncao();
            $funcao=$dao->localizarPorId($idfuncao);
            $descricao=$funcao->getDescricao();
        }
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
        echo("<items>");
        echo('<item type="fieldset" name="data" label="Classe" inputWidth="auto">');
        echo('<item type="hidden" name="id" value="'. $idfuncao . '"/>');
        echo('<item type="input" name="descricao" label="Descrição" value="'. $descricao .'" position="label-top"/>');
        echo('<item type="button" name="salvarclasse" value="Salvar"/>');
        echo('</item>');
        echo("</items>");
    }else if(isset($_POST['descricao'])){
        $dao=new DAOFuncao();
        $funcao=new Classe();
        $funcao->setId($_POST['id']);
        $funcao->setDescricao($_POST['descricao']);
        if($dao->gravar($funcao)){
            echo 'OK';
        }else{
            echo 'Erro Salvando Classe';
        }
    }else if(isset($_POST['excluir'])){
        $id=$_POST['id'];
        $dao=new DAOFuncao();
        if ($dao->excluir($id)){
            echo 'OK';
        }else{
            echo 'Erro Excluindo Classe';
        }
    }

?>
