<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aluno
 *
 * @author andre
 */
class Aluno extends Individuo {
   
    private $turma;
    private $matricula;
    
    public function getTurma() {
        return $this->turma;
    }

    public function setTurma($turma) {
        $this->turma = $turma;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }


}

?>
