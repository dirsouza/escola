<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 07/07/2018
 * Time: 22:03
 */

namespace App\Controller;

use App\Dao\ProfessorDao;
use App\Model\ProfessorModel;
use Slim\Slim;

class ProfessorController
{
    public static function viewIndex()
    {
        $dP = new ProfessorDao();
        $lista = $dP->lista();

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('professor/index.php', array(
            'prof' => $lista
        ));
        $slim->render('template/footer.php');
    }

    public static function viewNovo()
    {
        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('professor/novo.php');
        $slim->render('template/footer.php');
    }

    public static function novo(array $data)
    {
        $mP = new ProfessorModel($data);
        $dP = new ProfessorDao();
        $dP->salvar($mP);

        header("location: /professor");
        exit;
    }

    public static function viewEditar(int $id)
    {
        $dP = new ProfessorDao();
        $prof = $dP->listarId($id);

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('professor/editar.php', array(
            'prof' => $prof[0]
        ));
        $slim->render('template/footer.php');
    }

    public static function editar(int $id, array $data)
    {
        $mP = new ProfessorModel($data);
        $dP = new ProfessorDao();
        $dP->editar($mP, $id);

        header("location: /professor");
        exit;
    }

    public static function excluir(int $id)
    {
        $dP = new ProfessorDao();
        $dP->excluir($id);

        header("location: /professor");
        exit;
    }
}