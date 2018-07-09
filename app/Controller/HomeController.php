<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 07/07/2018
 * Time: 21:12
 */

namespace App\Controller;

use App\Dao\ProfessorDao;
use App\Dao\CursoDao;
use App\Dao\AlunoDao;
use Slim\Slim;

class HomeController
{
    public static function viewIndex()
    {
        $dP = new ProfessorDao();
        $prof = $dP->lista();

        $dC = new CursoDao();
        $curso = $dC->lista();

        $dA = new AlunoDao();
        $aluno = $dA->lista();

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('home/index.php', array(
            'prof' => count($prof),
            'curso' => count($curso),
            'aluno' => count($aluno)
        ));
        $slim->render('template/footer.php');
    }
}