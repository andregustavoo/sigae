<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOAtividade
 *
 * @author 20111144110262
 */
class DAOAtividade {
       public function gravar(Atividade $atividade){
       $sql='';
       $id=$atividade->getId();
       if (!isset($id) || ($atividade->getId()==0)){
            $sql01="insert into Atividade(id,atividade,data,hora,publico,descricao,grupoAtividade,Usuario) values(
            '".$atividade->getId() . "',
            '".$atividade->getatividade() . "',
            '".$atividade->getdata() . "',
            '".$atividade->gethora() . "',
            '".$atividade->getpublico() . "',
            '".$atividade->getDescricao() . "', 
            '".$atividade->getGrupoAtividade() . "',   
             ".$atividade->getUsuario()->getId().")";  
             }else{
           $sql="update Atividade set 
            Id='".$atividade->getId()."',
            atividade='".$atividade->getAtividade()."',
            data='".$atividade->getData()."',
            hora='".$atividade->getHora()."',
            publico='".$atividade->getPublico()."',
            descricao=".$atividade->getDescricao()."
            grupoatividade=".$atividade->getGrupoAtividade()."
            usuario=".$atividade->getUsuario()->getId().")"; 
       }
       try{
            $conexao=DAO::getConexao();
            $resultado=$conexao->exec($sql);
            return true;
       }catch(PDOException $error){
           return false;
       }
      
   }
   
   public function excluir($idatividade){
       $sql="delete from atividade where idaatividade=$idatividade";
       $conexao=DAO::getConexao();
       $resultado=$conexao->exec($sql);
       return $resultado;
   }
   
   public function localizarPorId($idatividade){
    $sql="select * from atividade where idatividade=$idatividade";
    $conexao=DAO::getConexao();
    $tabela=$conexao->query($sql);
    $registro=$tabela->fetch(PDO::FETCH_ASSOC);
      if ($registro){
          $atividade=new Atividade();
          $atividade->setId($registro['idatividade']);
          $atividade->setAtividade($registro['atividade']);
          $atividade->setData($registro['data']);
          $atividade->setHora($registro['hora']);
          $atividade->setPublico($registro['publico']);
          $atividade->setDescricao($registro['descricao']);
          $atividade->setGrupoAtividade($registro['grupoatividade']);
          $atividade->setUsuario($registro['usuario']); 
          $daoUsuario=new DAOUsuario();
          $atividade->setIndividuo($daoIndividuo->localizarPorId($registro['idindividuo']));
          $atividade->setUsuario($daoUsuario->localizarPorId($registro['idusuario']));
          return $atividade;
      }else{
          return null;
      }        
}}

?>
}

?>
