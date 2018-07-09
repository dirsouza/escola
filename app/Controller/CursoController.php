<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 07/07/2018
 * Time: 22:03
 */

namespace App\Controller;

Use App\Model\CursoModel;
use App\Dao\CursoDao;
use App\Dao\ProfessorDao;
use Slim\Slim;

class CursoController
{
    public static function viewIndex()
    {
        $dC = new CursoDao();
        $lista = $dC->lista();

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('curso/index.php', array(
            'curso' => $lista
        ));
        $slim->render('template/footer.php');
    }

    public static function viewNovo()
    {
        $dP = new ProfessorDao();
        $prof = $dP->lista();

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('curso/novo.php', array(
            'prof' => $prof
        ));
        $slim->render('template/footer.php');
    }

    public static function novo(array $data)
    {
        $mC = new CursoModel($data);
        $dC = new CursoDao();
        $dC->salvar($mC);

        $_SESSION['msg'] = "Curso <b>" . $data['nome'] . "</b> cadastrado com sucesso!";

        header("location: /curso");
        exit;
    }

    public static function viewEditar(int $id)
    {
        $dC = new CursoDao();
        $curso = $dC->listarId($id);

        $dP = new ProfessorDao();
        $prof = $dP->lista();

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('curso/editar.php', array(
            'curso' => $curso[0],
            'prof' => $prof
        ));
        $slim->render('template/footer.php');
    }

    public static function editar(int $id, array $data)
    {
        $mC = new CursoModel($data);
        $dC = new CursoDao();
        $dC->editar($mC, $id);

        $_SESSION['msg'] = "Os dados do Curso <b>" . $data['nome'] . "</b> foram atualizados com sucesso!";

        header("location: /curso");
        exit;
    }

    public static function excluir(int $id)
    {
        $dC = new CursoDao();
        $dC->excluir($id);

        $_SESSION['msg'] = "Curso excluído com sucesso!";

        header("location: /curso");
        exit;
    }
}