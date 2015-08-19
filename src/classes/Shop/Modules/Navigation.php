<?php

namespace Shop\Modules;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
 
 /**
  * 
  */
class Navigation
{
    public function render(Application $app)
    {
        return $app['twig']->render('modules/Navigation/index.twig');
    }

}