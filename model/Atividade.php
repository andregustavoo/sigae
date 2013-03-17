<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Atividade
 *
 * @author andre
 */
class Atividade {
    private $atividade;
    private $data;
    private $hora;
    private $publico;
    private $descricao;
    private $grupoAtividade;
    private $usuario;
    public function getAtividade() {
        return $this->atividade;
    }

    public function setAtividade($atividade) {
        $this->atividade = $atividade;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    public function getPublico() {
        return $this->publico;
    }

    public function setPublico($publico) {
        $this->publico = $publico;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getGrupoAtividade() {
        return $this->grupoAtividade;
    }

    public function setGrupoAtividade($grupoAtividade) {
        $this->grupoAtividade = $grupoAtividade;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }


}

?>
