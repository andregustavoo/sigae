<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOClasse
 *
 * @author 20102144110298
 */

class DAOClasse {
     public function gravar(Classe $classe){
      $sql='';
      $id=$classe->getId();
      if (!isset($id) || ($classe->getId()==0)){
          $sql="insert into classe(descricaoclasse)
                values(
              '".$classe->getDescricao()."')";
              
      }else{
          $sql="update classe set 
              descricaoclasse='".$classe->getDescricao()."'
                  where idclasse=".$classe->getId();
          
      }

      
        try{
            $conexao=DAO::getConexao();
            $resultado=$conexao->exec($sql);
            return true;
       }catch(PDOException $error){
           return false;
       }
     }
      
  public function excluir($idclasse){
      $sql="delete from classe where idclasse=$idclasse";
      $conexao=  DAO::getConexao();
      $resultado=$conexao->exec($sql);
      return $resultado;
  }
  public function localizarPorId($idclasse){
      $sql="select idclasse,descricaoclasse 
          from classe where idclasse=$idclasse";
      $conexao=DAO::getConexao();
      $tabela=$conexao->query($sql);
      $registro=$tabela->fetch(PDO::FETCH_ASSOC);
      if ($registro){
          $classe=new Classe();
          $classe->setId($registro['idclasse']);
          $classe->setDescricao($registro['descricaoclasse']);
          
          return $classe;
      }else{
          return null;
      }
  }
  
  public function listarClasses(){
      $sql="select idclasse,descricaoclasse from classe order by descricaoclasse";
      $conexao=DAO::getConexao();
      $tabela=$conexao->query($sql);
      $registros=$tabela->fetchAll();
      return $registros;
  }

}

?>
