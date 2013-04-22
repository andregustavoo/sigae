<?php
//Esse arquivo tem o nome classe, mas não se refere a tabela classe...    
include '../utils/carregaclassses.php';
require '../utils/gerarXML.php';       


?>

<?php

if (isset($_GET['consultar'])){
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"); 
        //Recupera dados da consulta
        $dao=new DAOAluno();
        $registros=$dao->listarAlunos();
        echo gerarXMLGrid($registros);
    }else if(isset($_GET['form'])){// usado para coletar valores em um formulário com method = "get".
        $idindividuo=0; // Por que o aluno começa em Zero?
        $nome=""; // Criando a variável $nome e está deixando-a vazia.
        $matricula=""; // Criando a variável $matricula e está deixando-a vazia.
        $turma=""; // Criando a variável $turma e está deixando-a vazia.
        $telefone=""; // Criando a variável $telefone e está deixando-a vazia.
        $email=""; // Criando a variável $email e está deixando-a vazia.
        $cpf=""; // Criando a variável $cpf e está deixando-a vazia.
        $datanascimento=""; // Criando a variável $datanascimento e está deixando-a vazia.
    
        if (isset($_GET['idindividuo'])){
            $idindividuo=$_GET['idindividuo'];
            $dao=new DAOAluno();
            $aluno=$dao->localizarPorId($idindividuo);
            $nome=$aluno->getNome();
            $cpf=$aluno->getCpf();
            $telefone=$aluno->getTelefone();
            $email=$aluno->getEmail();
            $datanascimento=$aluno->getDataNascimento();
            $turma=$aluno->getTurma();
            $matricula=$aluno->getMatricula();
        }
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
        echo("<items>");
        echo('<item type="fieldset" name="data" label="Aluno" inputWidth="auto">');
        echo('<item type="hidden" name="id" value="'. $idindividuo . '"/>');
        echo('<item type="input" name="nome" label="Nome" inputWidth="200" value="'. $nome .'" position="label-top"/>');
        echo('<item type="input" nome="matricula" label="Matricula" inputWidth="100" value="'.$matricula.'" position="label-top"/>');
        echo('<item type="input" nome="turma" label="Turma" inputWidth="150" value="'.$turma.'" position="label-top"/>');
        echo('<item type="input" name="email" label="E-Mail" inputWidht="150" value="'. $email .'" position="label-top"/>');
        echo('<item type="input" name="cpf" label="CPF" value="'. $cpf .'" position="label-top"/>');
        echo('<item type="input" name="telefone" label="Telefone" value="'. $telefone .'" position="label-top"/>');
        echo('<item type="calendar" name="datanascimento" label="Data de Nascimento" value="'. $datanascimento .'" position="label-top"/>');
        /* Para a classe precisamos montar um select com os elementos
         * Para tal precisamos consultar a relação de classes existentes
         */
        //* O que vocês queriam fazer aqui????? Vou comentar....
       /* $daoIndividuo=new DAOIndividuo();
        $registros=$daoIndividuo->listarIndividuo();
        echo('<item type="select" name="Individuo" label="Pessoa" position="label-top">');
        foreach($registros as $linha){
            
            if ($linha[0]==$idindividuo){
                 echo('<option value="'.$linha[0].'" text="'.$linha[1].'" selected="true"/>');
            }
            else {
              echo('<option value="'.$linha[0].'" text="'.$linha[1].'"/>');   
            }
            
        }
        echo('</item>');*/
        echo('<item type="button" name="salvaraluno" value="Salvar"/>');
        echo('</item>');
        echo("</items>");
    }else if(isset($_POST['nome']) && isset($_POST['cpf'])){
        /*
         * Gente,
         * Aluno é uma subclasse de indíviduo.....
         * Nãos e cria os dois, basta criar um aluno
         * e em seguida usar os métodos da classe.
         */
        $aluno=new Aluno();
        $aluno->setId($_POST['id']);
        $aluno->setNome($_POST['nome']);
        $aluno->setCpf($_POST['cpf']);
        $aluno->setEmail($_POST['email']);
        $aluno->setTelefone($_POST['telefone']);
        //Convertendo a data
        $datetime=  strtotime($_POST['datanascimento']);
        $datasql=date("Y-m-d",$datetime);
        $aluno->setDataNascimento($datasql);
        $aluno->setMatricula($_POST['matricula']);
        $aluno->setTurma($_POST['turma']);
        $dao=new DAOAluno();
        if($dao->gravar($aluno)){
            echo 'OK';
        }else{
            echo 'Erro Salvando Aluno';
        }
    }else if(isset($_POST['excluir'])){
        $id=$_POST['id'];
        $dao=new DAOAluno();
        if ($dao->excluir($id)){
            echo 'OK';
        }else{
            echo 'Erro Excluindo Aluno';
        }
    }
?>
