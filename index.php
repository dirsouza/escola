<?php
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");

define("PATH_VIEW", $_SERVER['DOCUMENT_ROOT'] . "/app/View");

require_once("vendor/autoload.php");

session_start();

use Slim\Slim;
use App\Controller\HomeController;

$app = new Slim();
$app->config(array(
    'debug' => true,
    'mode' => 'development'
));

/**
 * Index
 * Url: http://www.cadcli.com.br/index
 */
$app->get('/', function() {
    HomeController::home();
});

/**
 * Login
 * Url: http://www.cadcli.com.br/login
 */
require_once 'routes/login.php';

/**
 * Administrator
 * Url: http://www.cadcli.com.br/admin
 */
require_once 'routes/admin.php';

$app->run();