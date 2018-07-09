<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 07/07/2018
 * Time: 22:37
 */

namespace App\Controller;

use App\Dao\AlunoDao;
use App\Dao\RelatorioDao;
use Slim\Slim;

class RelatorioController
{
    const DADOS = null;

    public static function viewIndex()
    {
        $dR = new RelatorioDao();
        $tabelas = $dR->listaTabelas();

        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('relatorio/index.php', array(
            'tabelas' => $tabelas
        ));
        $slim->render('template/footer.php');
    }

    public static function viewRelatorio()
    {
        $dados = $_SESSION[self::DADOS];
        $modulo = $dados['modulo'];
        $tipo =  $dados['tipo'];
        unset($dados['modulo']);
        unset($dados['tipo']);

        self::{'view' . ucfirst(preg_replace('/tb/', '', $modulo))}($dados, $tipo);
    }

    public static function relatorio(array $data)
    {
        extract($data);
        self::{'get' . ucfirst(preg_replace('/tb/', '', $modulo))}($modulo, $tipo);
    }

    private function getAluno(string $modulo, string $tipo)
    {
        $dados = array(
            'modulo' => $modulo,
            'tipo' => $tipo
        );

        switch ($tipo) {
            case 'simplificado':
                $dA = new AlunoDao();
                $_SESSION[self::DADOS] = $dA->listaRelatorio()+$dados;
                break;
            case 'analitico':
                $dA = new AlunoDao();
                $_SESSION[self::DADOS] = $dA->listaRelatorio()+$dados;
                break;
        }
    }

    private function getCurso(string $tipo)
    {
        echo "Curso";
    }

    private function getProfessor(string $tipo)
    {
        echo "Professor";
    }

    private function viewAluno(array $dados, string $tipo)
    {
        $slim = new Slim();

        switch ($tipo) {
            case 'simplificado':
                $slim->render('aluno/relSimples.php', array(
                    'alunos' => $dados
                ));
                break;
            case 'analitico':
                $slim->render('aluno/relAnalitico.php', array(
                    'alunos' => $dados
                ));
        }
    }
}