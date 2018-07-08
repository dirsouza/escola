<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 07/07/2018
 * Time: 22:03
 */

namespace App\Controller;

use Slim\Slim;

class ProfessorController
{
    public static function viewIndex()
    {
        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('professor/index.php');
        $slim->render('template/footer.php');
    }
}