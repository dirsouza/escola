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
 * Curso
 * Url: http://www.escola.com.br/curso
 */
$app->group('/curso', function() use ($app) {
    $app->get('/', function() {
        CursoController::viewIndex();
    });

    $app->group('/novo', function() use ($app) {
        $app->get('/', function() {

        });

        $app->post('/', function() {

        });
    });

    $app->group('/editar', function() use ($app) {
        $app->get('/:id', function($id) {

        });

        $app->post('/:id', function($id) {

        });
    });

    $app->group('/excluir', function() use ($app) {
        $app->get('/:id', function($id) {

        });
    });
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

        });

        $app->post('/', function() {

        });
    });

    $app->group('/editar', function() use ($app) {
        $app->get('/:id', function($id) {

        });

        $app->post('/:id', function($id) {

        });
    });

    $app->group('/excluir', function() use ($app) {
        $app->get('/:id', function($id) {

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

        });

        $app->post('/', function() {

        });
    });

    $app->group('/editar', function() use ($app) {
        $app->get('/:id', function($id) {

        });

        $app->post('/:id', function($id) {

        });
    });

    $app->group('/excluir', function() use ($app) {
        $app->get('/:id', function($id) {

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
});

$app->run();