<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author andre
 */
class Usuario extends Individuo {
    private $login;
    private $senha;
    private $administrador;
    private $funcao;
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getAdministrador() {
        return $this->administrador;
    }

    public function setAdministrador($administrador) {
        $this->administrador = $administrador;
    }

    public function getFuncao() {
        return $this->funcao;
    }

    public function setFuncao(Funcao $funcao) {
        $this->funcao = $funcao;
    }


}

?>
