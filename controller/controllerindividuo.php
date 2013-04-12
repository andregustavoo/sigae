<?php
    
include '../utils/carregaclassses.php';
require '../utils/gerarXML.php';       
    ?>
<?php

    if (isset($_GET['consultar'])){
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"); 
        //Recupera dados da consulta
        $dao=new DAOIndividuo();
        $registros=$dao->listarIndividuos();
        echo gerarXMLGrid($registros);
    }else if(isset($_GET['form'])){
        $idindividuo=0;
        $nome="";
        $telefone="";
        $email="";
        $cpf="";
        $datanascimento="";
        $idclasse=0;
        if (isset($_GET['idindividuo'])){
            $idindividuo=$_GET['idindividuo'];
            $dao=new DAOIndividuo();
            $individuo=$dao->localizarPorId($idindividuo);
            $nome=$individuo->getNome();
            $cpf=$individuo->getCpf();
            $telefone=$individuo->getTelefone();
            $email=$individuo->getEmail();
            $datanascimento=$individuo->getDataNascimento();
            $idclasse=$individuo->getClasse()->getId();
        }
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
        echo("<items>");
        echo('<item type="fieldset" name="data" label="Pessoa" inputWidth="auto">');
        echo('<item type="hidden" name="id" value="'. $idindividuo . '"/>');
        echo('<item type="input" name="nome" label="Nome" inputWidth="200" value="'. $nome .'" position="label-top"/>');
        echo('<item type="input" name="email" label="E-Mail" inputWidht="150" value="'. $email .'" position="label-top"/>');
        echo('<item type="input" name="cpf" label="CPF" value="'. $cpf .'" position="label-top"/>');
        echo('<item type="input" name="telefone" label="Telefone" value="'. $telefone .'" position="label-top"/>');
        echo('<item type="calendar" name="datanascimento" label="Data de Nascimento" value="'. $datanascimento .'" position="label-top"/>');
        /* Para a classe precisamos montar um select com os elementos
         * Para tal precisamos consultar a relação de classes existentes
         */
        $daoClasse=new DAOClasse();
        $registros=$daoClasse->listarClasses();
        echo('<item type="select" name="classe" label="Classe" position="label-top">');
        foreach($registros as $linha){
            if ($linha[0]==$idclasse){
                 echo('<option value="'.$linha[0].'" text="'.$linha[1].'" selected="true"/>');
            }
            else {
              echo('<option value="'.$linha[0].'" text="'.$linha[1].'"/>');   
            }
            
        }
        echo('</item>');
        echo('<item type="button" name="salvarindividuo" value="Salvar"/>');
        echo('</item>');
        echo("</items>");
    }else if(isset($_POST['nome']) && isset($_POST['cpf'])){
        
        $individuo=new Individuo();
        $individuo->setId($_POST['id']);
        $individuo->setNome($_POST['nome']);
        $individuo->setCpf($_POST['cpf']);
        $individuo->setEmail($_POST['email']);
        $individuo->setTelefone($_POST['telefone']);
        //Convertendo a data
        $datetime=  strtotime($_POST['datanascimento']);
        $datasql=date("Y-m-d",$datetime);
        $individuo->setDataNascimento($datasql);
        $classe=new Classe();
        $classe->setId($_POST['classe']);
        $individuo->setClasse($classe);
        $dao=new DAOIndividuo();
        if($dao->gravar($individuo)){
            echo 'OK';
        }else{
            echo 'Erro Salvando Individuo';
        }
    }else if(isset($_POST['excluir'])){
        $id=$_POST['id'];
        $dao=new DAOIndividuo();
        if ($dao->excluir($id)){
            echo 'OK';
        }else{
            echo 'Erro Excluindo Individuo';
        }
    }

