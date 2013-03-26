<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOGrupoAtividade
 *
 * @author 20111144110165
 */

class DAOGrupoAtividade {
    public function gravar(GrupoAtividade $grupoatividade){
        $sql='';
        $id=$grupoatividade->getId();
        if (!isset($id) || $grupoatividade->getId()==0){
            $sql = "insert into grupoatividade(descricaogrupoatividade)
                values('".$grupoatividade->getDescricao()."')";
        }
        else{
            $sql="update grupoatividade set 
                descricaogrupoatividade='".$grupoatividade->getDescricao()."'
                    where idgrupoatividade".$grupoatividade->getId();
        }
        
        try{
            $conexao=DAO::getConexao();
            $resultado=$conexao->exec($sql);
            return true;
        }catch(PDOException $error){
            return false;
        }
    }
    
    public function excluir($idgrupoatividade){
        $sql = "delete from grupoatividade where idgrupoatividade = $idgrupoatividade";
        $conexao = DAO::getConexao();
        $resultado = $conexao->exec($sql);
        return $resultado;
    }
    
    public function localizarPorId($idgrupoatividade){
        $sql = "select idgrupoatividade,descricaogrupoatividade
            from grupoatividade where idgrupoatividade = $idgrupoatividade";
        $conexao = DAO::getConexao();
        $tabela = $conexao->query($sql);
        $registro = $tabela->fetch(PDO::FETCH_ASSOC);
        if ($registro){
            $grupoatividade = new GrupoAtividade();
            $grupoatividade->getId($registro['idgrupoatividade']);
            $grupoatividade->setDescricao($registro['descricaogrupoatividade']);
            return $grupoatividade;
        }
        else{
            return null;
        }
    }

}


?>
