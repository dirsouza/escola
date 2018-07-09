<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 08/07/2018
 * Time: 17:20
 */

namespace App\Model;

use Core\Helpers;

class CursoModel
{
    private $idCurso;
    private $nome;
    private $idProfessor;
    private $dtCadastro;

    /**
     * Seta os dados de enviados
     * ProfessorModel constructor.
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        $helpers = new Helpers();

        foreach ($fields as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                if ($helpers->catchErrors((string)$key, (string)$value, self::rules())) {
                    $this->{$method}(trim($value));
                }
            }
        }

        if (!empty($helpers->getErrors())) {
            $helpers->sessionErro($_SERVER['REQUEST_URI'], $fields);
        }
    }

    /**
     * Regra dos compos
     * @return array
     */
    public function rules()
    {
        return array(
            'required' => array('nome', 'idProfessor'),
            'unique' => array('nome')
        );
    }

    /**
     * @return mixed
     */
    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     * @param mixed $idCurso
     */
    public function setIdCurso($idCurso)
    {
        $this->idCurso = $idCurso;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getIdProfessor()
    {
        return $this->idProfessor;
    }

    /**
     * @param mixed $idProfessor
     */
    public function setIdProfessor($idProfessor)
    {
        $this->idProfessor = $idProfessor;
    }

    /**
     * @return mixed
     */
    public function getDtCadastro()
    {
        return $this->dtCadastro;
    }

    /**
     * @param mixed $dtCadastro
     */
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
    }
}