<?php

namespace Shop\Controllers;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

 /**
  * 
  */
class PageController
{
	protected $app;
	protected $db;
	protected $twig;
	
	public function __construct(Application $app) {
		$this->app = $app;
		$this->db = $app['db'];
		$this->twig = $app['twig'];
	}
	
	public function render($url, $params = array(), $layout = 'layout') {
		$page = $this->getPage($url);
		$html = array();
		
		foreach ( $page['modules'] as $slot => $modules ) {	
			if ( !isset($html[$slot]) ){
				$html[$slot] = array();
			}
			foreach ( $modules as $m ) {
				$c = "Shop\\Modules\\".$m['module_controller'];
				$controller = new $c($this->app);		
				$html[$slot][] = array('content' => $controller->indexAction( array_merge($params,$m) ));
			}
		}
		
		$navigation = new \Shop\Modules\Navigation();
			
        return $this->twig->render($page['layout'].'.twig', array( 'page' => $page, 'modules' => $html, 'navigation' => $navigation->render($this->app) ));
	}
	
	public function getPage( $url ) {	
		$page = $this->db->fetchAssoc("SELECT * FROM pages WHERE url=?", array($url));
		$page['modules'] = $this->getPageModules($page['page_id']);
		return $page;
	}
	
	public function getPageModules( $page_id ) {
		$result = $this->db->fetchAll('SELECT * FROM page_modules, modules WHERE modules.module_id=page_modules.module_id AND page_modules.page_id=? ORDER BY module_slot, module_order', array($page_id));		
		
		$modules = array('top' => array(), 'content' => array(), 'bottom' => array(), 'left' => array(), 'footer' => array());
		foreach ( $result as $m ) {
			$modules[strtolower($m['module_slot'])][] = $m;
		}
		
		return $modules;
	}

}