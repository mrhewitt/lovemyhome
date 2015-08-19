<?php

namespace Shop\Modules;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

 /**
  * 
  */
class ProductColumn extends \Shop\Modules\ModuleController {

	public function indexAction($module) {
		
		$items = $this->db->fetchAll("SELECT * FROM products LIMIT 2");
		$module['items'] = $items;
		$module['item_layout'] = 'modules/common/item_3.twig';
		
		return parent::indexAction($module);
	}
	
}