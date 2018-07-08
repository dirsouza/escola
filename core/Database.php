<?php

namespace Core;

class Database
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * Inicia Conexão com o Banco de Dados
     * Database constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        /**
         * @var Config[db]
         */
        $dbConf = Config::getConfig('db_development');

        /**
         * @var Attributes \PDO
         */
        $attributes = array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );

        try {
            $this->db = new \PDO($dbConf['dtbase'].":dbname=".$dbConf['dbname'].";host=".$dbConf['host'].";",$dbConf['user'],$dbConf['pass'], $attributes);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }
}