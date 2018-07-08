<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 08/07/2018
 * Time: 12:54
 */

namespace App\Model;

use Core\Helpers;

class ProfessorModel
{
    private $idProfessor;
    private $nome;
    private $dtNascimento;
    private $dtCriacao;

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
     * Regra dos comapos
     * @return array
     */
    public function rules()
    {
        return array(
            'required' => array('nome', 'dtNascimento'),
            'unique' => array('nome')
        );
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
    public function getDtNascimento()
    {
        return $this->dtNascimento;
    }

    /**
     * @param mixed $dtNascimento
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
    }

    /**
     * @return mixed
     */
    public function getDtCriacao()
    {
        return $this->dtCriacao;
    }

    /**
     * @param mixed $dtCriacao
     */
    public function setDtCriacao($dtCriacao)
    {
        $this->dtCriacao = $dtCriacao;
    }
}