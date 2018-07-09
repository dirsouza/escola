<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 07/07/2018
 * Time: 22:03
 */

namespace App\Controller;

use App\Dao\AlunoDao;
use App\Dao\CursoDao;
use App\Model\AlunoModel;
use Slim\Slim;

class AlunoController
{
    public static function viewIndex()
    {
        $dA = new AlunoDao();
        $lista = $dA->lista();

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('aluno/index.php', array(
            'aluno' => $lista
        ));
        $slim->render('template/footer.php');
    }

    public static function viewNovo()
    {
        $dC = new CursoDao();
        $curso = $dC->lista();

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('aluno/novo.php', array(
            'curso' => $curso
        ));
        $slim->render('template/footer.php');
    }

    public static function novo(array $data)
    {
        $mA = new AlunoModel($data);
        $dA = new AlunoDao();
        $dA->salvar($mA);

        $_SESSION['msg'] = "Aluno <b>" . $data['nome'] . "</b> cadastrado com sucesso!";

        header("location: /aluno");
        exit;
    }

    public static function viewEditar(int $id)
    {
        $dA = new AlunoDao();
        $aluno = $dA->listarId($id);

        $dA = new CursoDao();
        $curso = $dA->lista();

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('aluno/editar.php', array(
            'aluno' => $aluno[0],
            'curso' => $curso
        ));
        $slim->render('template/footer.php');
    }

    public static function editar(int $id, array $data)
    {
        $_id = ['idAluno' => $id];
        $data += $_id;

        $mA = new AlunoModel($data);
        $dA = new AlunoDao();
        $dA->editar($mA, $id);

        $_SESSION['msg'] = "Os dados do Aluno <b>" . $data['nome'] . "</b> foram atualizados com sucesso!";

        header("location: /aluno");
        exit;
    }

    public static function excluir(int $id)
    {
        $dA = new AlunoDao();
        $dA->excluir($id);

        $_SESSION['msg'] = "Aluno excluído com sucesso!";

        header("location: /aluno");
        exit;
    }
}