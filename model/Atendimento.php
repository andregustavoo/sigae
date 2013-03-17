<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Atendimento
 *
 * @author andre
 */
class Atendimento {
   private $dataAtendimento;
   private $motivo;
   private $encaminhamento;
   private $orientacao;
   private $observacao;
   private $individuo;
   private $usuario;
   
   public function getDataAtendimento() {
       return $this->dataAtendimento;
   }

   public function setDataAtendimento($dataAtendimento) {
       $this->dataAtendimento = $dataAtendimento;
   }

   public function getMotivo() {
       return $this->motivo;
   }

   public function setMotivo($motivo) {
       $this->motivo = $motivo;
   }

   public function getEncaminhamento() {
       return $this->encaminhamento;
   }

   public function setEncaminhamento($encaminhamento) {
       $this->encaminhamento = $encaminhamento;
   }

   public function getOrientacao() {
       return $this->orientacao;
   }

   public function setOrientacao($orientacao) {
       $this->orientacao = $orientacao;
   }

   public function getObservacao() {
       return $this->observacao;
   }

   public function setObservacao($observacao) {
       $this->observacao = $observacao;
   }

   public function getIndividuo() {
       return $this->individuo;
   }

   public function setIndividuo(Individuo $individuo) {
       $this->individuo = $individuo;
   }

   public function getUsuario() {
       return $this->usuario;
   }

   public function setUsuario(Usuario $usuario) {
       $this->usuario = $usuario;
   }


}

?>
