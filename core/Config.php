<?php

namespace Core;

class Config
{
    const CONFIG = array(
        'system' => array (
            'name' => 'Cadastro de Clientes',
            'abbrev' => 'CADCli',
            'version' => '1.0.0'
        ),
        'db' => array (
            'dtbase' => 'mysql',
            'host' => 'localhost',
            'user' => 'root',
            'pass' => 'root',
            'dbname' => 'db_cadcli'
        )
    );

    /**
     * @param string $parameter
     * @return array
     * @throws \Exception
     */
    public static function getConfig(string $parameter)
    {
        foreach (self::CONFIG as $p => $v) {
            if ($p == $parameter) {
                return self::CONFIG[$parameter];
                break;
            }
        }

        throw new \Exception("Parâmetro não encontrado.");
    }
}