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
        $registros=$dao->listarFuncoes();
        echo gerarXMLGrid($registros);
    }else if(isset($_GET['form'])){
        $idfuncao=0;
        $descricao="";
        $setor="";
        if (isset($_GET['idfuncao'])){
            $idfuncao=$_GET['idfuncao'];
            $dao=new DAOFuncao();
            $funcao=$dao->localizarPorId($idfuncao);
            $descricao=$funcao->getDescricao();
            $setor=$funcao->getSetor();
        }
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
        echo("<items>");
        echo('<item type="fieldset" name="data" label="Função" inputWidth="auto">');
        echo('<item type="hidden" name="id" value="'. $idfuncao . '"/>');
        echo('<item type="input" name="descricao" label="Descrição" value="'. $descricao .'" position="label-top"/>');
         echo('<item type="input" name="setor" label="Setor" value="'. $setor .'" position="label-top"/>');
        echo('<item type="button" name="salvarfuncao" value="Salvar"/>');
        echo('</item>');
        echo("</items>");
    }else if(isset($_POST['descricao'])){
        $dao=new DAOFuncao();
        $funcao=new Funcao();
        $funcao->setId($_POST['id']);
        $funcao->setDescricao($_POST['descricao']);
        $funcao->setSetor($_POST['setor']);
        if($dao->gravar($funcao)){
            echo 'OK';
        }else{
            echo 'Erro Salvando Função';
        }
    }else if(isset($_POST['excluir'])){
        $id=$_POST['id'];
        $dao=new DAOFuncao();
        if ($dao->excluir($id)){
            echo 'OK';
        }else{
            echo 'Erro Excluindo Função';
        }
    }

?>
