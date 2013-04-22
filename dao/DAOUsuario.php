<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOUsuario
 *
 * @author andre
 */
class DAOUsuario {
    public function gravar(Usuario $usuario){
        $idusuario=$usuario->getId();
        $sql01="";//SQL para cadastrar/atualiza um individuo
        $sql02="";//SQL para cadastrar/atualizar um usuario
        $conexao=DAO::getConexao();
        if (!isset($idusuario) || $usuario->getId()==0){
            $sql01="insert into individuo(nome,telefone,datanascimento,email,cpf,idclasse) values(
            '".$usuario->getNome()."',
            '".$usuario->getTelefone()."',
            '".$usuario->getDataNascimento()."',
            '".$usuario->getEmail()."',
            '".$usuario->getCpf()."',
            ".$usuario->getClasse()->getId().")";
            try{
                  $conexao->beginTransaction();        
                  
                  $res=$conexao->exec($sql01);
                  if ($res){
                      $idindividuo=$conexao->lastInsertId();
                      $sql02="insert into usuario(login,senha,administrador,idindividuo,idfuncao) values(
                      '".$usuario->getLogin()."',
                      '".$usuario->getSenha()."',
                      '".$usuario->getAdministrador()."',
                      '".$idindividuo."',
                      ".$usuario->getFuncao()->getId().")";
             
                      $resultado=$conexao->exec($sql02);
           
                      if($resultado){
                          $conexao->commit();
                          return true;
                      }else{
                          $conexao->rollBack();
                          return false;
                      }
                  }else{
                      return false;
                  }
            }  catch (PDOException $error){
                $conexao->rollBack();
                echo $error->getMessage();
                return false;
            }
          
        }else{
            $sql01="update individuo set
            nome='".$usuario->getNome()."',
            telefone='".$usuario->getTelefone()."',
            datanascimento='".$usuario->getDataNascimento()."',
            email='".$usuario->getEmail()."',
            cpf='".$usuario->getCpf()."',
            idclasse=".$usuario->getClasse()->getId()."
            where idindividuo=".$usuario->getId();
            try{
                $conexao->beginTransaction();
                $res=$conexao->exec($sql01);
                $sql02="update usuario set login='".$usuario->getLogin()."',
                senha='".$usuario->getSenha()."',
                administrador='".$usuario->getAdministrador()."', 
                idfuncao=". $usuario->getFuncao()->getId()."                    
                where idindividuo=".$usuario->getId();
                $resultado=$conexao->exec($sql02);
                $conexao->commit();
                return true;

            }  catch (PDOException $error){
                echo $error->getMessage();
                $conexao->rollBack();
                return false;
            }
        }
        
    }
    
    public function excluir($idindividuo){
        $sql01="delete from individuo where idindividuo=".$idindividuo;
        $sql02="delete from usuario where individuo=".$idindividuo;
        $conexao=DAO::getConexao();
        try{
            if ($conexao->exec($sql01)){
                if($conexao->exec($sql02)){
                    $conexao->commit();
                    return true;
                }else{
                    $conexao->rollBack();
                    return false;
                }
            }
        }catch(Exception $error){
            $conexao->rollBack();
            return false;
        }
        
    }
    
    public function localizarPorId($idindividuo){
        $sql="select usuario.idindividuo as idusuario,nome,datanascimento,telefone,email,cpf,idclasse,login,senha,administrador,idfuncao
            from individuo inner join usuario on individuo.idindividuo=usuario.idindividuo where usuario.idindividuo=$idindividuo";
        $conexao=DAO::getConexao();
        $tabela=$conexao->query($sql);
        $registro=$tabela->fetch(PDO::FETCH_ASSOC);
        if ($registro){
            $usuario=new Usuario();
            $usuario->setId($registro['idusuario']);
            $usuario->setNome($registro['nome']);
            $usuario->setDataNascimento($registro['datanascimento']);
            $usuario->setTelefone($registro['telefone']);
            $usuario->setEmail($registro['email']);
            $usuario->setCpf($registro['cpf']);
            //Recupera os dados da classe 
            $daoClasse=new DAOClasse();
            $usuario->setClasse($daoClasse->localizarPorId($registro['idclasse']));
            $usuario->setLogin($registro['login']);
            $usuario->setSenha($registro['senha']);
            $usuario->setAdministrador($registro['administrador']);
            //Recupera os dados da funcao
            $daoFuncao=new DAOFuncao();
            $usuario->setFuncao($daoFuncao->localizarPorId($registro['idfuncao']));
            return $usuario;
        }
        return null;
    }
    
    public function listarUsuarios(){
    $sql='select usuario.idindividuo as idusuario,nome,date_format(datanascimento,"%d-%m-%Y") as data_nascimento,telefone,
        email,cpf,idclasse,login,senha,administrador,idfuncao from individuo inner join usuario on 
        individuo.idindividuo=usuario.idindividuo order by nome';
    $conexao=DAO::getConexao();
    $tabela=$conexao->query($sql);
    $registros=$tabela->fetchAll();
    return $registros;
}
}

?>
