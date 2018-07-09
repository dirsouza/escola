<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 09/07/2018
 * Time: 12:15
 */

namespace App\Dao;

use App\Model\ProfessorModel;
use App\Model\CursoModel;
use App\Model\AlunoModel;
use Core\Database;
use Core\Helpers;

class RelatorioDao extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listaTabelas()
    {
        $sql = $this->db->prepare("SHOW TABLES");
        $sql->execute();

        return $sql->fetchAll();
    }
}