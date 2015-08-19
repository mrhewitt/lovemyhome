<?php

namespace Shop\Modules;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

 /**
  * 
  */
class ModuleController  {
	
	protected $app;
	protected $db;
	protected $twig;
	
	protected $default_template = 'index.twig';
	
	public function __construct(Application $app) {
		$this->app = $app;
		$this->db = $app['db'];
		$this->twig = $app['twig'];

	}

	
	public function indexAction($module) {
		return $this->render($module);
	}
	
	protected function render( $params = array(), $template = false ) {
		$path = "modules/".strtolower(array_pop(explode('\\',get_class($this)))).'/'.( empty($template) ? $this->default_template : $template );
		return $this->twig->render($path, $params);
	}
}