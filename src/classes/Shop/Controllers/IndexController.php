<?php

namespace Shop\Controllers;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Shop;

 /**
  * 
  */
class IndexController
{
    public function indexAction(Application $app)
    {
		$page = new Shop\PageController($app);
        return $page->render('/');
    }

	public function shopAction(Application $app, $cat1, $cat2, $product) {
		
		// create a new twig filter for expressing negative values as absolute value in parentesis
		$filter = new \Twig_SimpleFilter('urlify', function ($value) {
			return str_replace(' ','-',strtolower($value));
		});
		$app['twig']->addFilter($filter);

		$filter = new \Twig_SimpleFilter('curreny', function ($value) {
			return 'R'.number_format($value,2);
		});
		$app['twig']->addFilter($filter);

		$page = new Shop\Controllers\PageController($app);
        return $page->render('shop', array('cat1' => $cat1, 'cat2' => $cat2, 'product' => $product));
	}
	
    public function pageAction(Application $app, $url)
    {
		$page = new Shop\PageController($app);
        return $page->render($url);
    }
    
	public function itemsAction(Application $app)
    {
        return $app['twig']->render('items.twig');
    }
    
	public function contactAction(Application $app)
    {
		$modules = array();
		foreach ( array('Contact') as $m ) {
			$c = "Shop\\Modules\\{$m}";
			$controller = new $c;		
			$modules[] = array('content' => $controller->indexAction($app));
		}
		
        return $app['twig']->render('contact.twig', array( 'modules' => $modules ) );
    }

}