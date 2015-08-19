<?php

namespace Shop\Modules;
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

 /**
  * 
  */
class ShopViewer extends \Shop\Modules\ModuleController {

	public function indexAction($module) {
		$this->default_template = 'items.twig';
		
		if ( !empty($module['cat1']) ) {
			$category = $this->db->fetchAssoc("SELECT * FROM category WHERE parent_id IS NULL AND category_name = ?", array($module['cat1']));
			$module['cat1'] = $category['category_name'];
		}
		if ( !empty($module['cat2']) ) {
			$category = $this->db->fetchAssoc("SELECT * FROM category WHERE parent_id = ? AND category_name = ?", array($category['category_id'],$module['cat2']));
			$module['cat2'] = $category['category_name'];
		}
		
		$items = $this->db->fetchAll("SELECT * FROM products");
		
		$module['items'] = $items;
		$module['category'] = $category;
		$module['item_layout'] = 'modules/common/item_1.twig';
		
		return parent::indexAction($module);
	}
	
}