<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 08/07/2018
 * Time: 18:55
 */

namespace App\Model;

use Core\Helpers;

class AlunoModel
{
    private $idAluno;
    private $nome;
    private $dtNascimento;
    private $cep;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $idCurso;
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
     * Regra dos campos
     * @return array
     */
    public function rules()
    {
        return array(
            'required' => array('nome', 'dtNascimento', 'cep', 'logradouro', 'numero', 'bairro', 'cidade', 'estado', 'idCurso')
        );
    }

    /**
     * @return mixed
     */
    public function getIdAluno()
    {
        return $this->idAluno;
    }

    /**
     * @param mixed $idAluno
     */
    public function setIdAluno($idAluno)
    {
        $this->idAluno = $idAluno;
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
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param mixed $logradouro
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
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