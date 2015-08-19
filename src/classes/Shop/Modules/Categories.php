<?php

namespace Shop\Modules;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

 /**
  * 
  */
class Categories extends \Shop\Modules\ModuleController {

	public function indexAction($module) {
		
		return parent::indexAction($module);
	}
	
}