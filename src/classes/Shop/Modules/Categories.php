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
		
		$result = $this->db->fetchAll("SELECT * FROM category");
		$categories = array();
		foreach ( $result as $c ) {
			if ( empty($c['parent_id']) ) {
				if ( !isset($categories[$c['category_id']]) ) {
					$c['categories'] = array();
					$categories[$c['category_id']] = $c;
				} else {
					$categories[$c['category_id']] = array_merge($categories[$c['category_id']],$c);
				}
			} else {
				if ( !isset($categories[$c['parent_id']]) ) {
					$categories[$c['parent_id']] = array( 'categories' => array($c) );
				} else {
					$categories[$c['parent_id']]['categories'][] = $c;
				}
			}			
		}
		
		$module['categories'] = $categories;
		return parent::indexAction($module);
	}
	
}