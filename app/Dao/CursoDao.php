<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 08/07/2018
 * Time: 17:22
 */

namespace App\Dao;

use App\Model\CursoModel;
use Core\Database;
use Core\Helpers;

class CursoDao extends Database
{
    /**
     * Chama o construtor da conexão
     * CursoDao constructor.
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
        $sql = $this->db->prepare("SELECT a.*, b.nome AS 'professor' FROM tbcurso a INNER JOIN tbprofessor b USING (idProfessor)");
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
        $sql = $this->db->prepare("SELECT * FROM tbcurso WHERE idCurso = ?");
        $sql->execute([$id]);
        return $sql->fetchAll();
    }

    /**
     * Inseri os dados na Tabela
     * @param CursoModel $f
     */
    public function salvar(CursoModel $f)
    {
        $fields = array(
            'nome' => $f->getNome(),
            'idProfessor' => $f->getIdProfessor()
        );

        for ($i = 0; $i < count(array_keys($fields)); $i++) {
            $q[] = "?";
        }

        if (self::validarDados($f)) {
            $helpers = new Helpers();
            $helpers->setErrors("O Curso informado já consta no banco de dados.");
            $helpers->sessionErro($_SERVER['REQUEST_URI'], $fields);
        }

        $sql = $this->db->prepare(
            "INSERT INTO tbcurso (" . implode(',', array_keys($fields)) . ") VALUES (" . implode(',', array_values($q)) . ")"
        );
        $sql->execute(array_values($fields));
    }

    /**
     * Editar os dados na Tabela
     * @param CursoModel $f
     * @param int $id
     */
    public function editar(CursoModel $f, int $id)
    {
        $fields = array(
            'nome' => $f->getNome(),
            'idProfessor' => $f->getIdProfessor()
        );

        foreach ($fields as $key => $value) {
            $q[] = $key . " = ?";
        }

        if (self::validarDados($f)) {
            $helpers = new Helpers();
            $helpers->setErrors("O Curso informado já consta no banco de dados.");
            $helpers->sessionErro($_SERVER['REQUEST_URI'], $fields);
        }

        $sql = $this->db->prepare(
            "UPDATE tbcurso SET " . implode(',', array_values($q)) . " WHERE idCurso = ?"
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
        $sql = $this->db->prepare("DELETE FROM tbcurso WHERE idCurso = ?");
        $sql->execute([$id]);
    }

    /**
     * Valida os dados da Tabela pelas Regras
     * @param CursoModel $f
     * @return bool
     */
    private function validarDados(CursoModel $f)
    {
        $rules = $f->rules();
        $result = self::lista();

        foreach ($result as $key) {
            foreach ($rules['unique'] as $r => $value) {
                if ($key[$value] === $f->{'get' . ucfirst($value)}() && $key['idProfessor'] === $f->getIdProfessor()) {
                    return true;
                }
            }
        }
        return false;
    }
}