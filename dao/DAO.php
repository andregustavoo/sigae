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
            $conexao=new PDO('mysql:host=10.210.1.101;port=3306;dbname=sigae','info4','info4');
            return $conexao;
        }
    }
}

?>
