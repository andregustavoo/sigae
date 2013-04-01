<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOResponsavel
 *
 * @author 20111144110424
 */
class DAOResponsavel {
  public function gravar(Responsavel $responsavel){
      $sql='';
      $id=$responsavel->getId();
      $responsavelpor_idindividuo=$responsavel->getResponsavelPor()->getId();
      $aluno_idindividuo=$responsavel->getAluno()->getId();
      if (!isset($id) || ($responsavel->getId()==0)){
          $sql="insert into responsavel(responsavelpor_idindividuo,aluno)
                values(
              '".$responsavel->getrResponsavelPor_idindividuo()."'
                  '".$responsavel->getAluno()."')";
              
      }else{
          $sql="update responsavel set 
              responsavelpor_idindividuo='".$responsavel->getResponsavelPor()."'
              aluno_idindividuo='".$responsavel->getAluno()."'    
                  where idresponsavel=".$responsavel->getId();
          
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
      $sql="delete from responsavel where idresponsavel=$idresponsavel";
      $conexao=  DAO::getConexao();
      $resultado=$conexao->exec($sql);
      return $resultado;
  }
  public function localizarPorId($idresponsavel){
      $sql="select idresponsavel,responsavelpor_individuo,aluno_idindividuo 
          from responsavel where idresponsavel=$idresponsavel";
      $conexao=DAO::getConexao();
      $tabela=$conexao->query($sql);
      $registro=$tabela->fetch(PDO::FETCH_ASSOC);
      if ($registro){
          $responsavel=new Responsavel();
          $responsavel->setId($registro['idresponsavel']);
          $responsavel->setResponsavelPor_idindividuo($registro['responsavelpor']);
          $responsavel->setAluno_idindividuo($registro['aluno']);
          
          return $responsavel;
      }else{
          return null;
      }
  }
  
  public function listarResponsaveis(){
      $sql="select idresponsavel,responsavelpor_idindividuo from responsavel order by responsavelpor_idindividuo";
      $conexao=DAO::getConexao();
      $tabela=$conexao->query($sql);
      $registros=$tabela->fetchAll();
      return $registros;
  }
  
  public function listarAlunos(){
      $sql="select idresponsavel,aluno_idindividuo from responsavel order by aluno_idindividuo";
      $conexao=DAO::getConexao();
      $tabela=$conexao->query($sql);
      $registros=$tabela->fetchAll();
      return $registros;
  }
}

?>
