<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAO
 *
 * @author andre
 */
class DAO {
    private static $conexao;
    public static function  getConexao(){
        if (isset($conexao)){
            return $conexao;
        }else{
            //Lembrar de modificar esse arquivo na hora de testar em casa, colocando as informações da sua conexão
            $conexao=new PDO('mysql:host=10.210.1.101;port=3306;dbname=sigae','info4','info4');
            //Adicionado para permitir o uso de acentos na hora de salvar os dados
            $conexao->exec("set names utf8");
            return $conexao;
        }
    }
}

?>
