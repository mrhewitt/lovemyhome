<?php

namespace Shop\Modules;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
 
 /**
  * 
  */
class Contact
{
    public function indexAction(Application $app)
    {
        return $app['twig']->render('modules/Contact/index.twig');
    }

}