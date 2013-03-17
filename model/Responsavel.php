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
    private $responsavelPor;
    private $aluno;
    public function getResponsavelPor() {
        return $this->responsavelPor;
    }

    public function setResponsavelPor(Individuo $responsavelPor) {
        $this->responsavelPor = $responsavelPor;
    }

    public function getAluno() {
        return $this->aluno;
    }

    public function setAluno(Individuo $aluno) {
        $this->aluno = $aluno;
    }


}

?>
