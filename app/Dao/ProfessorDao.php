<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 08/07/2018
 * Time: 13:00
 */

namespace App\Dao;

use App\Model\ProfessorModel;
use Core\Database;
use Core\Helpers;

class ProfessorDao extends Database
{
    /**
     * Chama o construtor da conexão
     * ProfessorDao constructor.
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
        $sql = $this->db->prepare("SELECT * FROM tbprofessor");
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
        $sql = $this->db->prepare("SELECT * FROM tbprofessor WHERE idProfessor = ?");
        $sql->execute([$id]);
        return $sql->fetchAll();
    }

    /**
     * Inseri os dados na Tabela
     * @param ProfessorModel $f
     */
    public function salvar(ProfessorModel $f)
    {
        $fields = array(
            'nome' => $f->getNome(),
            'dtNascimento' => $f->getDtNascimento()
        );

        for ($i = 0; $i < count(array_keys($fields)); $i++) {
            $q[] = "?";
        }

        if (self::validarDados($f)) {
            $helpers = new Helpers();
            $helpers->setErrors("O Professor informado já consta no banco de dados.");
            $helpers->sessionErro($_SERVER['REQUEST_URI'], array(
                'nome' => $f->getNome(),
                'dtNascimento' => $f->getDtNascimento()
            ));
        }

        $sql = $this->db->prepare(
            "INSERT INTO tbprofessor (" . implode(',', array_keys($fields)) . ") VALUES (" . implode(',', array_values($q)) . ")"
        );
        $sql->execute(array_values($fields));
    }

    /**
     * Editar os dados na Tabela
     * @param ProfessorModel $f
     * @param int $id
     */
    public function editar(ProfessorModel $f, int $id)
    {
        $fields = array(
            'nome' => $f->getNome(),
            'dtNascimento' => $f->getDtNascimento()
        );

        foreach ($fields as $key => $value) {
            $q[] = $key . " = ?";
        }

        if (self::validarDados($f)) {
            $helpers = new Helpers();
            $helpers->setErrors("O Professor informado já consta no banco de dados.");
            $helpers->sessionErro($_SERVER['REQUEST_URI'], array(
                'nome' => $f->getNome(),
                'dtNascimento' => $f->getDtNascimento()
            ));
        }

        $sql = $this->db->prepare(
            "UPDATE tbprofessor SET " . implode(',', array_values($q)) . " WHERE idProfessor = ?"
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
        $sql = $this->db->prepare("DELETE FROM tbprofessor WHERE idProfessor = ?");
        $sql->execute([$id]);
    }

    /**
     * Valida os dados da Tabela pelas Regras
     * @param ProfessorModel $f
     * @return bool
     */
    private function validarDados(ProfessorModel $f)
    {
        $rules = $f->rules();
        $result = self::lista();

        foreach ($result as $key) {
            foreach ($rules['unique'] as $r => $value) {
                if ($key[$value] === $f->{'get' . ucfirst($value)}()) {
                    return true;
                }
            }
        }
        return false;
    }
}