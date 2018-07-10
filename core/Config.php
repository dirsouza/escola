<?php

namespace Core;

class Config
{
    const CONFIG = array(
        'db_development' => array (
            'dtbase' => 'mysql',
            'host' => 'localhost',
            'user' => 'root',
            'pass' => 'root',
            'dbname' => 'db_escola'
        ),
        'db_production' => array (
            'dtbase' => 'mysql',
            'host' => 'fdb18.awardspace.net',
            'user' => '2554622_escola',
            'pass' => 'skew@534',
            'dbname' => '2554622_escola'
        )
    );

    /**
     * Retorna a configuração
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