<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Responsavel
 *
 * @author andre
 */
class Responsavel {
    private $id;
    private $responsavelPor;
    private $aluno;
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

        public function getResponsavelPor() {
        return $this->responsavelPor;
    }

    public function setResponsavelPor(Individuo $responsavelPor) {
        $this->responsavelPor = $responsavelPor;
    }

    public function getAluno() {
        return $this->aluno;
    }

    public function setAluno(Aluno $aluno) {
        $this->aluno = $aluno;
    }


}

?>
