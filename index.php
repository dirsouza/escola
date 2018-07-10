<?php
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");

define("PATH_VIEW", $_SERVER['DOCUMENT_ROOT'] . "/app/View");

require_once("vendor/autoload.php");

session_start();

use Slim\Slim;
use App\Controller\HomeController;
use App\Controller\CursoController;
use App\Controller\ProfessorController;
use App\Controller\AlunoController;
use App\Controller\RelatorioController;

$app = new Slim();
$app->config(array(
    'debug' => true,
    'mode' => 'development'
));

/**
 * Home
 * Url: http://www.escola.com.br/
 */
$app->get('/', function() {
    HomeController::viewIndex();
});

/**
 * Professor
 * Url: http://www.escola.com.br/professor
 */
$app->group('/professor', function() use ($app) {
    $app->get('/', function() {
        ProfessorController::viewIndex();
    });

    $app->group('/novo', function() use ($app) {
        $app->get('/', function() {
            ProfessorController::viewNovo();
        });

        $app->post('/', function() {
            ProfessorController::novo($_POST);
        });
    });

    $app->group('/editar', function() use ($app) {
        $app->get('/:id', function($id) {
            ProfessorController::viewEditar((int)$id);
        });

        $app->post('/:id', function($id) {
            ProfessorController::editar((int)$id, $_POST);
        });
    });

    $app->group('/excluir', function() use ($app) {
        $app->get('/:id', function($id) {
            ProfessorController::excluir((int)$id);
        });
    });
});

/**
 * Curso
 * Url: http://www.escola.com.br/curso
 */
$app->group('/curso', function() use ($app) {
    $app->get('/', function() {
        CursoController::viewIndex();
    });

    $app->group('/novo', function() use ($app) {
        $app->get('/', function() {
            CursoController::viewNovo();
        });

        $app->post('/', function() {
            CursoController::novo($_POST);
        });
    });

    $app->group('/editar', function() use ($app) {
        $app->get('/:id', function($id) {
            CursoController::viewEditar((int)$id);
        });

        $app->post('/:id', function($id) {
            CursoController::editar((int)$id, $_POST);
        });
    });

    $app->group('/excluir', function() use ($app) {
        $app->get('/:id', function($id) {
            CursoController::excluir((int)$id);
        });
    });
});

/**
 * Aluno
 * Url: http://www.escola.com.br/aluno
 */
$app->group('/aluno', function() use ($app) {
    $app->get('/', function() {
        AlunoController::viewIndex();
    });

    $app->group('/novo', function() use ($app) {
        $app->get('/', function() {
            AlunoController::viewNovo();
        });

        $app->post('/', function() {
            AlunoController::novo($_POST);
        });
    });

    $app->group('/editar', function() use ($app) {
        $app->get('/:id', function($id) {
            AlunoController::viewEditar((int)$id);
        });

        $app->post('/:id', function($id) {
            AlunoController::editar((int)$id, $_POST);
        });
    });

    $app->group('/excluir', function() use ($app) {
        $app->get('/:id', function($id) {
            AlunoController::excluir((int)$id);
        });
    });
});

/**
 * Relatório
 * Url: http://www.escola.com.br/relatorio
 */
$app->group('/relatorio', function() use ($app) {
    $app->get('/', function() {
        RelatorioController::viewIndex();
    });

    $app->post('/', function() {
        RelatorioController::relatorio($_POST);
    });

    $app->get('/visualizar', function() {
        RelatorioController::viewRelatorio();
    });
});

$app->run();