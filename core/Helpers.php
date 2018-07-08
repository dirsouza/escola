<?php

namespace Core;


class Helpers
{
    private $errors;

    /**
     * Verifica os dados enviados pelas Regras
     * @param string $field
     * @param string $value
     * @param array $rules
     * @return bool
     */
    public function catchErrors(string $field, string $value, array $rules = array())
    {
        if (!empty($rules)) {
            foreach ($rules['required'] as $key => $r) {
                if ($r === $field) {
                    if (empty(trim($value))) {
                        $this->setErrors("O campo <b>" . ucfirst(str_replace('dt', '', $field)) . "</b> não foi informado.");
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * Retorna os erros
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Seta os erros
     * @param string $error
     */
    public function setErrors(string $error)
    {
        if (strlen($this->errors) == 0) {
            $this->errors = $error;
        } else {
            $this->errors .= "<hr>" . $error;
        }
    }

    /**
     * Inicia Sessão dos erros
     * @param string|null $url
     * @param array $data
     */
    public function sessionErro(string $url = null, array $data = array())
    {
        if ($url === null) {
            $url = "/";
        }

        $_SESSION['erro'] = array(
            'msg' => $this->getErrors(),
            'fields' => $data
        );

        header("location: " . $url);
        exit;
    }
}