<?php
    
include '../utils/carregaclassses.php';
require '../utils/gerarXML.php';       
?>
<?php

    if (isset($_GET['consultar'])){
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"); 
        //Recupera dados da consulta
        $dao=new DAOUsuario();
        $registros=$dao->listarUsuarios();
        echo gerarXMLGrid($registros);
    }else if(isset($_GET['form'])){
        $idusuario=0;
        $nome="";
        $telefone="";
        $datanascimento="";
        $email="";
        $cpf="";
        $idclasse=0;
        /*****/
        $login="";
        $senha="";
        $administrador="";
        $idfuncao=0;
        /*****/
        
        if (isset($_GET['idusuario'])){
            $idusuario=$_GET['idusuario'];
            $dao=new DAOUsuario();
            $usuario=$dao->localizarPorId($idusuario);
            $nome=$usuario->getNome();
            $telefone=$usuario->getTelefone();
            $datanascimento=$usuario->getDataNascimento();
            $email=$usuario->getEmail();
            $cpf=$usuario->getCpf();
            $idclasse=$usuario->getClasse()->getId();
           /*****/
            $login=$usuario->getLogin();
            $senha=$usuario->getSenha();
            $administrador=$usuario->getAdministrador();
            $idfuncao=$usuario->getFuncao()->getId();
           /******/
        }
        header("Content-type: text/xml");
        echo("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
        echo("<items>");
        echo('<item type="fieldset" name="data" label="Usuário" inputWidth="auto">');
        echo('<item type="hidden" name="id" value="'. $idusuario . '"/>');
        echo('<item type="input" name="nome" label="Nome" inputWidth="200" value="'. $nome .'" position="label-top"/>');
        echo('<item type="input" name="telefone" label="Telefone" value="'. $telefone .'" position="label-top"/>');
        echo('<item type="calendar" name="datanascimento" label="Data de Nascimento" value="'. $datanascimento .'" position="label-top"/>');
        echo('<item type="input" name="email" label="E-Mail" inputWidht="150" value="'. $email .'" position="label-top"/>');
        echo('<item type="input" name="cpf" label="CPF" value="'. $cpf .'" position="label-top"/>');       
	/* Para a classe precisamos montar um select com os elementos
         * Para tal precisamos consultar a relação de classes existentes
         */
        $daoClasse=new DAOClasse();
        $registrosclasse=$daoClasse->listarClasses();
        echo('<item type="select" name="classe" label="Classe" position="label-top">');
        foreach($registrosclasse as $linhaclasse){
            if ($linhaclasse[0]==$idclasse){
                 echo('<option value="'.$linhaclasse[0].'" text="'.$linhaclasse[1].'" selected="true"/>');
            }
            else {
              echo('<option value="'.$linhaclasse[0].'" text="'.$linhaclasse[1].'"/>');   
            }       
        }
        echo('</item>');
        
        /*****Adicionando atributos da própria classe USUARIO******/
	echo('<item type="input" name="login" label="Login" value="'. $login .'" position="label-top"/>');
        echo('<item type="password" name="senha" label="Senha" value="'. $senha .'" position="label-top"/>');
	echo('<item type="input" name="administrador" label="Administrador" value="'. $administrador .'" position="label-top"/>');
        $daoFuncao=new DAOFuncao();
        $registrosfuncao=$daoFuncao->listarfuncoes();
        echo('<item type="select" name="funcao" label="Função" position="label-top">');
        foreach($registrosfuncao as $linhafuncao){
            if ($linhafuncao[0]==$idfuncao){
                 echo('<option value="'.$linhafuncao[0].'" text="'.$linhafuncao[1].'" selected="true"/>');
            }
            else {
              echo('<option value="'.$linhafuncao[0].'" text="'.$linhafuncao[1].'"/>');   
            }
        }
        echo('</item>');
	/***********************************************************/
  
        echo('<item type="button" name="salvarusuario" value="Salvar"/>');
        echo('</item>');
        echo("</items>");
    }else if(isset($_POST['nome']) && isset($_POST['cpf'])){
        $dao=new DAOUsuario(); 
        $usuario=new Usuario();
        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setTelefone($_POST['telefone']);
        //Convertendo a data
        $datetime=  strtotime($_POST['datanascimento']);
        $datasql=date("Y-m-d",$datetime);
        $usuario->setDataNascimento($datasql);
        $usuario->setEmail($_POST['email']);
        $usuario->setCpf($_POST['cpf']);
        $classe=new Classe();
        $classe->setId($_POST['classe']);
        $usuario->setClasse($classe);
        
        /**ATRIBUTOS DE USUÁRIO**/
        $usuario->setLogin($_POST['login']);
        $usuario->setSenha($_POST['senha']);
        $usuario->setAdministrador($_POST['administrador']);
        $funcao=new Funcao();
        $funcao->setId($_POST['funcao']);
        $usuario->setFuncao($funcao);
        
        if($dao->gravar($usuario)){
            echo 'OK';
        }else{
            echo 'Erro Salvando Usuário';
        }
    }else if(isset($_POST['excluir'])){
        $id=$_POST['id'];
        $dao=new DAOUsuario();
        if ($dao->excluir($id)){
            echo 'OK';
        }else{
            echo 'Erro Excluindo Usuário';
        }
    }
    
?>