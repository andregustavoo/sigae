<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOAtendimento
 *
 * @author 20102144110352
 */
class DAOAtendimento {
    public function gravar(Atendimento $atendimento){
       $sql='';
       $id=$atendimento->getId();
       if (!isset($id) || ($atendimento->getId()==0)){
           $sql="insert into atendimento(dataatendimento,motivo,encaminhamento,orientacao,observacao,idindividuo,idusuario) values(
            '".$atendimento->getDataAtendimento()."',
            '".$atendimento->getMotivo()."',
            '".$atendimento->getEncaminhamento()."',
            '".$atendimento->getOrientacao()."',
            '".$atendimento->getObservacao()."',
             ".$atendimento->getIndividuo()->getId().",
             ".$atendimento->getUsuario()->getId().")";  
       }else{
           $sql="update atendimento set 
            dataatendimento='".$atendimento->getDataAtendimento()."',
            motivo='".$atendimento->getMotivo()."',
            encaminhamento='".$atendimento->getEncaminhamento()."',
            orientacao='".$atendimento->getOrientacao()."',
            observacao='".$atendimento->getObservacao()."',
            idindividuo=".$atendimento->getIndividuo()->getId()."
            idusuario=".$atendimento->getUsuario()->getId()."
            where idatendimento=".$atendimento->getId();
       }
       try{
            $conexao=DAO::getConexao();
            $resultado=$conexao->exec($sql);
            return true;
       }catch(PDOException $error){
           return false;
       }
      
   }
   
   public function excluir($idatendimento){
       $sql="delete from atendimento where idatendimento=$idatendimento";
       $conexao=DAO::getConexao();
       $resultado=$conexao->exec($sql);
       return $resultado;
   }
   
   public function localizarPorId($idatendimento){
    $sql="select * from atendimento where idatendimento=$idatendimento";
    $conexao=DAO::getConexao();
    $tabela=$conexao->query($sql);
    $registro=$tabela->fetch(PDO::FETCH_ASSOC);
      if ($registro){
          $atendimento=new Atendimento();
          $atendimento->setId($registro['idatendimento']);
          $atendimento->setDataAtendimento($registro['dataatendimento']);
          $atendimento->setMotivo($registro['motivo']);
          $atendimento->setEncaminhamento($registro['encaminhamento']);
          $atendimento->setOrientacao($registro['orientacao']);
          $atendimento->setObservacao($registro['observacao']);
          //Localizando as informações da classe
          $daoIndividuo=new DAOIndividuo();
          $daoUsuario=new DAOUsuario();
          $atendimento->setIndividuo($daoIndividuo->localizarPorId($registro['idindividuo']));
          $atendimento->setUsuario($daoUsuario->localizarPorId($registro['idusuario']));
          return $atendimento;
      }else{
          return null;
      }        
}
}

?>
