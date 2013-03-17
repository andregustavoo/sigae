<?php
require 'DAO.php';
require  $_SERVER['DOCUMENT_ROOT'] .'/sigae/model/Funcao.php';
class DAOFuncao {
  public function gravar(Funcao $funcao){
      $sql="insert into funcao(descricaofuncao,setor)
                values(
              '".$funcao->getDescricao()."',
              '".$funcao->getSetor()."')";
      $conexao=DAO::getConexao();
      $resultado=$conexao->exec($sql);
      return $resultado;
  } 
}

?>
