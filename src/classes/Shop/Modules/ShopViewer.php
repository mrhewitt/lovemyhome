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
		
		if ( !empty($module['cat1']) ) {
			$category = $this->db->fetchAssoc("SELECT * FROM category WHERE parent_id IS NULL AND category_name = ?", array($module['cat1']));
			$module['cat1'] = $category['category_name'];
		}
		if ( !empty($module['cat2']) ) {
			$category = $this->db->fetchAssoc("SELECT * FROM category WHERE parent_id = ? AND category_name = ?", array($category['category_id'],$module['cat2']));
			$module['cat2'] = $category['category_name'];
		}
		$module['category'] = $category;
		
		if ( !empty($module['product']) ) {
			return $this->singleItemView($module);
		} else {
			return $this->listView($module);
		}
	}
	
	private function singleItemView($module) {
	
		// find the poduct
		$item = $this->db->fetchAssoc("SELECT * FROM products WHERE product_name=?", array(str_replace('-',' ',$module['product'])));
		$module['product'] = $item;
		return $this->render($module,'single-item.twig');
	}

	private function listView($module) {
		
		$items = $this->db->fetchAll("SELECT * FROM products");
		
		$module['items'] = $items;
		$module['item_layout'] = 'modules/common/item_1.twig';
		
		return $this->render($module,'items.twig');
	}		
	
}