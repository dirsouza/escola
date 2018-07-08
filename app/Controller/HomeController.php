<?php
/**
 * Created by PhpStorm.
 * User: diogo.souza
 * Date: 07/07/2018
 * Time: 21:12
 */

namespace App\Controller;

use Slim\Slim;

class HomeController
{
    public static function viewIndex()
    {
        $slim = new Slim();
        $slim->render('template/header.php');
        $slim->render('home/index.php');
        $slim->render('template/footer.php');
    }
}