<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 08/07/2018
 * Time: 18:58
 */

namespace App\Dao;

use App\Model\AlunoModel;
use Core\Database;
use Core\Helpers;

class AlunoDao extends Database
{
    /**
     * Chama o construtor da conexão
     * AlunoDao constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Lista os dados da Tabela
     * @return array
     */
    public function lista()
    {
        $sql = $this->db->prepare("SELECT a.*, b.nome AS 'curso' FROM tbaluno a INNER JOIN tbcurso b USING (idCurso)");
        $sql->execute();
        return $sql->fetchAll();
    }

    /**
     * Lista os dados da Tabela pelo ID
     * @param int $id
     * @return array
     */
    public function listarId(int $id)
    {
        $sql = $this->db->prepare("SELECT * FROM tbaluno WHERE idAluno = ?");
        $sql->execute([$id]);
        return $sql->fetchAll();
    }

    /**
     * Inseri os dados na Tabela
     * @param AlunoModel $f
     */
    public function salvar(AlunoModel $f)
    {
        $fields = array(
            'nome' => $f->getNome(),
            'dtNascimento' => $f->getDtNascimento(),
            'cep' => $f->getCep(),
            'logradouro' => $f->getLogradouro(),
            'numero' => $f->getNumero(),
            'bairro' => $f->getBairro(),
            'cidade' => $f->getCidade(),
            'estado' => $f->getEstado(),
            'idCurso' => $f->getIdCurso()
        );

        for ($i = 0; $i < count(array_keys($fields)); $i++) {
            $q[] = "?";
        }

        if (self::validarDados($f)) {
            $helpers = new Helpers();
            $helpers->setErrors("O Aluno informado já consta cadastrado para esse curso.");
            $helpers->sessionErro($_SERVER['REQUEST_URI'], $fields);
        }

        $sql = $this->db->prepare(
            "INSERT INTO tbaluno (" . implode(',', array_keys($fields)) . ") VALUES (" . implode(',', array_values($q)) . ")"
        );
        $sql->execute(array_values($fields));
    }

    /**
     * Editar os dados na Tabela
     * @param AlunoModel $f
     * @param int $id
     */
    public function editar(AlunoModel $f, int $id)
    {
        $fields = array(
            'nome' => $f->getNome(),
            'dtNascimento' => $f->getDtNascimento(),
            'cep' => $f->getCep(),
            'logradouro' => $f->getLogradouro(),
            'numero' => $f->getNumero(),
            'bairro' => $f->getBairro(),
            'cidade' => $f->getCidade(),
            'estado' => $f->getEstado(),
            'idCurso' => $f->getIdCurso()
        );

        foreach ($fields as $key => $value) {
            $q[] = $key . " = ?";
        }

        $sql = $this->db->prepare(
            "UPDATE tbaluno SET " . implode(',', array_values($q)) . " WHERE idAluno = ?"
        );

        array_push($fields, $id);
        $sql->execute(array_values($fields));
    }

    /**
     * Exclui os dados da Tabela
     * @param int $id
     */
    public function excluir(int $id)
    {
        $sql = $this->db->prepare("DELETE FROM tbaluno WHERE idAluno = ?");
        $sql->execute([$id]);
    }

    /**
     * Valida os dados da Tabela
     * @param AlunoModel $f
     * @return bool
     */
    private function validarDados(AlunoModel $f)
    {
        $alunos = self::lista();

        foreach ($alunos as $index => $aluno) {
            if ($aluno['nome'] === $f->getNome() && $aluno['idCurso'] === $f->getIdCurso()) {
                return true;
            }
        }
        return false;
    }
}