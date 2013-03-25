<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOIndividuo
 *
 * @author giovannig
 */
class DAOIndividuo {
   public function gravar(Individuo $individuo){
       $sql='';
       $id=$individuo->getId();
       if (!isset($id) || ($individuo->getId()==0)){
           $sql="insert into individuo(nome, telefone,datanascimento,email,cpf,idclasse) values(
            '" . $individuo->getNome() . "',
            '".$individuo->getTelefone() . "',
            '". $individuo->getDataNascimento() . "',
            '". $individuo->getEmail() . "',
            '".$individuo->getCpf() . "',
             " . $individuo->getClasse()->getId().")";  
       }else{
           $sql="update individuo set 
            nome='" . $individuo->getNome() . "',
            telefone='".$individuo->getTelefone() . "',
            datanascimento='". $individuo->getDataNascimento() . "',
            email='". $individuo->getEmail() . "',
            cpf='".$individuo->getCpf() . "',
            idclasse=" . $individuo->getClasse()->getId()."
            where idindividuo=". $individuo->getId();
       }
       $conexao=DAO::getConexao();
       echo $sql;
       $resultado=$conexao->exec($sql);
       return $resultado;
   }
   public function excluir($idindividuo){
       $sql="delete from individuo where idindividuo=$idindividuo";
       $conexao=DAO::getConexao();
       $resultado=$conexao->exec($sql);
       return $resultado;
   }
public function localizarPorId($idindividuo){
    $sql="select * from individuo where idindividuo=$idindividuo";
    $conexao=DAO::getConexao();
    $tabela=$conexao->query($sql);
    $registro=$tabela->fetch(PDO::FETCH_ASSOC);
      if ($registro){
          $individuo=new Individuo();
          $individuo->setId($registro['id']);
          $individuo->setNome($registro['nome']);
          $individuo->setCpf($registro['cpf']);
          $individuo->setTelefone($registro['telefone']);
          $individuo->setEmail($registro['email']);
          //Localizando as informações da classe
          $daoClasse=new DAOClasse();
          $individuo->setClasse($daoClasse->localizarPorId($registro['idclasse']));
          return $individuo;
      }else{
          return null;
      }
        
}
}
    



?>
