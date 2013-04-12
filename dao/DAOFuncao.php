<?php

class DAOFuncao {
  public function gravar(Funcao $funcao){
      $sql='';
      $id=$funcao->getId();
      if (!isset($id) || $funcao->getId()==0){
          $sql="insert into funcao(descricaofuncao,setor)
                values(
              '".$funcao->getDescricao()."',
              '".$funcao->getSetor()."')";
      }else{
          $sql="update funcao set 
              descricaofuncao='".$funcao->getDescricao()."',
              setor='".$funcao->getSetor()."'
                  where idfuncao=".$funcao->getId(); 
      }
      
      try{
            $conexao=DAO::getConexao();
            $resultado=$conexao->exec($sql);
            return true;
       }catch(PDOException $error){
           return false;
       }
  }
  public function excluir($idfuncao){
      $sql="delete from funcao where idfuncao=$idfuncao";
      $conexao=  DAO::getConexao();
      $resultado=$conexao->exec($sql);
      return $resultado;
  }
  public function localizarPorId($idfuncao){
      $sql="select idfuncao,descricaofuncao,setor 
          from funcao where idfuncao=$idfuncao";
      $conexao=DAO::getConexao();
      $tabela=$conexao->query($sql);
      $registro=$tabela->fetch(PDO::FETCH_ASSOC);
      if ($registro){
          $funcao=new Funcao();
          $funcao->setId($registro['idfuncao']);
          $funcao->setDescricao($registro['descricaofuncao']);
          $funcao->setSetor($registro['setor']);
          return $funcao;
      }else{
          return null;
      } 
  }
public function listarFuncoes(){
    $sql="select idfuncao,descricaofuncao,setor from funcao order by descricaofuncao";
    $conexao=DAO::getConexao();
    $tabela=$conexao->query($sql);
    $registros=$tabela->fetchAll();
    return $registros;
}
}

?>
