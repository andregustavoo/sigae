<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DAOAluno
 *
 * @author 20111144110041
 */
class DAOAluno {
   
    /*
     * Tanto Aluno como Usuário precisam de tratamento diferenciado,
     * uma vez que antes de cadastrar um aluno, devemos cadastrar um individuo
     * Isso vai requerer que o processo de gravação seja realizado em duas etapas:
     * 1 - Gravar um indivíduo
     * 2 - Gravar um novo aluno usando o idIndividuo gerado pelo processo de gravação
     * do individuo.
     * Como precisamos fazer duas alterações ao mesmo tempo e uma não funciona sem a outra
     * precisaremos lançar mão do use de transações, que garante que a operação ou é totalmente
     * concluida ou tudo deve ser desfeito
     */
    public function gravar(Aluno $aluno){
        $idaluno=$aluno->getId();
        $sql01="";//SQL para cadastrar/atualiza um individuo
        $sql02="";//SQL para cadastrar/atualizar um aluno
        $conexao=DAO::getConexao();
        if (!isset($idaluno) || $aluno->getId()==0){
            $sql01="insert into individuo(nome, telefone,datanascimento,email,cpf,idclasse) values(
            '" . $aluno->getNome() . "',
            '".$aluno->getTelefone() . "',
            '". $aluno->getDataNascimento() . "',
            '". $aluno->getEmail() . "',
            '".$aluno->getCpf() . "',
             " . $aluno->getClasse()->getId().")";
            try{
                  $conexao->beginTransaction();
        
                  $res=$conexao->exec($sql01);
                  if ($res){
                      $idindividuo=$conexao->lastInsertId();
                      $sql02="insert into aluno(matricula,turma,idindividuo) values(
                      '". $aluno->getMatricula() . "',
                      '". $aluno->getTurma() . "',
                      ".$idindividuo.")";
             
                      $resultado=$conexao->exec($sql02);
           
                      if($resultado){
                          $conexao->commit();
                          return true;
                      }else{
                          $conexao->rollBack();
                          return false;
                      }
                  }else{
                      return false;
                  }
            }  catch (PDOException $error){
                $conexao->rollBack();
                echo $error->getMessage();
                return false;
            }
          
        }else{
             $sql01="update individuo set
            nome='" . $aluno->getNome() . "',
            telefone='".$aluno->getTelefone() . "',
            datanascimento='". $aluno->getDataNascimento() . "',
            email='". $aluno->getEmail() . "',
            cpf='".$aluno->getCpf() . "',
             idclasse=" . $aluno->getClasse()->getId()."
             where idindividuo=".$aluno->getId();
            try{
                $conexao->beginTransaction();
                $res=$conexao->exec($sql01);
                $sql02="update aluno set matricula='". $aluno->getMatricula() . "',
                turma='". $aluno->getTurma() . "'
                where idindividuo=".$aluno->getId();
                $resultado=$conexao->exec($sql02);
                $conexao->commit();
                return true;

            }  catch (PDOException $error){
                echo $error->getMessage();
                $conexao->rollBack();
                return false;
            }
        }
        
    }
    /*
     * Idem anteriores, é necessário usar transação para excluir tanto o indíviduo como o
     * aluno
     */
    public function excluir($idindividuo){
        $sql01="delete from individuo where idindividuo=".$idindividuo;
        $sql02="delete from aluno where individuo=".$idindividuo;
        $conexao=DAO::getConexao();
        try{
            //Mudando apenas o estilo de verificar se a operação foi realizada com sucesso
            if ($conexao->exec($sql01)){
                if($conexao->exec($sql02)){
                    $conexao->commit();
                    return true;
                }else{
                    $conexao->rollBack();
                    return false;
                }
            }
        }catch(Exception $error){
            $conexao->rollBack();
            return false;
        }
        
    }
    /*
     * Para localizar podemos montar um SQL única ou utilizar o método localizarPorId da classe
     * DAOIndividuo para recuperar os dados referentes ao índividuo, complementando apenas
     * as informações do aluno. Nesse momento optaremos por utilizar a primeira opção
     */
    public function localizarPorId($idindividuo){
        $sql="select aluno.idindividuo as idaluno,nome,datanascimento,telefone,email,cpf,idclasse,matricula,turma from
individuo inner join aluno on individuo.idindividuo=aluno.idindividuo where aluno.idindividuo=$idindividuo";
        $conexao=DAO::getConexao();
        $tabela=$conexao->query($sql);
        $registro=$tabela->fetch(PDO::FETCH_ASSOC);
        if ($registro){
            $aluno=new Aluno();
            $aluno->setId($registro['idaluno']);
            $aluno->setNome($registro['nome']);
            $aluno->setCpf($registro['cpf']);
            $aluno->setTelefone($registro['telefone']);
            $aluno->setDataNascimento($registro['datanascimento']);
            $aluno->setMatricula($registro['matricula']);
            $aluno->setEmail($registro['email']);
            $aluno->setTurma($registro['turma']);
            //Recupera os dados da classe
            $daoClasse=new DAOClasse();
            $aluno->setClasse($daoClasse->localizarPorId($registro['idclasse']));
            return $aluno;
        }
        return null;
    }
public function listarAluno(){
    $sql='select aluno matricula,turma,nome,date_format(datanascimento,"%d-%m-%Y") as data_nascimento,telefone,email,cpf
from aluno inner join individuo on aluno.idindividuo=individuo.idindividuo
order by nome';
    $conexao=DAO::getConexao();
    $tabela=$conexao->query($sql);
    $registros=$tabela->fetchAll();
    return $registros;
}
}

?>
