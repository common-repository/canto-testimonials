<?php
/**
* Custom Post type Class
* 
*/
if (!class_exists('Canto_CustomPostType')) {
	class Canto_CustomPostType{
		//Properties

		private $pTypeArgs = array();
		private $TXTDOMAIN = '';

		function __construct($args = array()){
			
			$this->pTypeArgs = $args;

			$this->TXTDOMAIN = $this->pTypeArgs['txtdomain'];

			$this->registerPostType();
		}

		//Register Post type
		private function registerPostType(){
			$postType = ucfirst($this->pTypeArgs['postType']);
			$postTypeDesc = $this->pTypeArgs['postTypeDesc'];
			$public = $this->pTypeArgs['postTypePublic'];

			//Menu Name
			$menuName = __($postType, $this->TXTDOMAIN);
			if (isset($this->pTypeArgs['pTypeMenuName'])) {
				$menuName = __($this->pTypeArgs['pTypeMenuName'], $this->TXTDOMAIN);
			}
			$args = array(
				'labels' => array(
		               'name' => __($postType, $this->TXTDOMAIN),
		               'singular_name'  => __($postType, $this->TXTDOMAIN),
		               'add_new' => __('Add New', $this->TXTDOMAIN),
		               'add_new_item' => __('Add New',$this->TXTDOMAIN),
		               'edit_item' => __('Edit', $this->TXTDOMAIN),
		               'new_item' => __('Add New', $this->TXTDOMAIN),
		               'view_item' => __('View', $this->TXTDOMAIN),
		               'search_item' => __('Search ' . $postType, $this->TXTDOMAIN),
		               'not_found' => __('No ' . $postType . ' Found', $this->TXTDOMAIN),
		               'not_found_in_trash' => __('No ' . $postType . ' Found in Trush', $this->TXTDOMAIN),
		               'menu_name' => $menuName
		           ),
					'description' => $postTypeDesc,
		           'query_var' => isset($this->pTypeArgs['postType']) ? strtolower($this->pTypeArgs['postType']) : true,
		           'rewrite' => $this->pTypeArgs['pTypeRewrite'],
		           'public' => isset($public) ? $public : false,
		           'publicly_queryable' => isset($this->pTypeArgs['pTypePQueryable']) ? $this->pTypeArgs['pTypePQueryable'] : $public,
		           'exclude_from_search' => isset($this->pTypeArgs['pTypePExSearch']) ? $this->pTypeArgs['pTypePExSearch'] : $public,
		           'show_ui' => isset($this->pTypeArgs['pTypePShowUI']) ? $this->pTypeArgs['pTypePShowUI'] : $public,
		           'show_in_nav_menus' => isset($this->pTypeArgs['pTypeShowInNavMenu']) ? $this->pTypeArgs['pTypeShowInNavMenu'] : $public,
		           'show_in_menu' => isset($this->pTypeArgs['pTypeShowMenu']) ? $this->pTypeArgs['pTypeShowMenu'] : null,
		           'menu_position' => isset($this->pTypeArgs['pTypeMenuPos']) ? $this->pTypeArgs['pTypeMenuPos'] : null,
		           'supports' => $this->pTypeArgs['pTypeSupport'],
		           'menu_icon' => isset($this->pTypeArgs['pTypeIconURL']) ? $this->pTypeArgs['pTypeIconURL'] : null,
		           'hierarchical' => isset($this->pTypeArgs['pTypeHierarchical']) ? $this->pTypeArgs['pTypeHierarchical'] : false,
		           'has_archive' => isset($this->pTypeArgs['pTypeHasArchive']) ? $this->pTypeArgs['pTypeHasArchive'] : false
				);
			register_post_type(strtolower($this->pTypeArgs['postType']), $args);
		}
		public function getPostType(){
			$r = '';
			$r = strtolower($this->pTypeArgs['postType']);

			return $r;
		}

		public function getTxtDomain(){
			$r = '';
			$r = $this->TXTDOMAIN;

			return $r;
		}
	}
}

?>