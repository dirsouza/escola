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
            'host' => 'sql313.hostfree.pw',
            'user' => 'epree_22356623',
            'pass' => 'skew@534',
            'dbname' => 'epree_22356623_escola'
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