<?php
if (!class_exists('Canto_customTaxonomy')) {
	class Canto_customTaxonomy{
		//Properties
		private $tax_id = '';
		private $tax_name = '';
		private $tax_slug = '';
		private $tax_hierarchical = false;
		
		private $tax_cpostType = array();
		private $tax_txtDomain = '';

		//Constractor
		function __construct($args = array()){
			$this->tax_id = strtolower($args['id']);
			$this->tax_name = ucwords($args['name']);
			$this->tax_txtDomain = $args['txtDomain'];
			$this->tax_cpostType = $args['cPostType'];
			$this->tax_slug = $args['slug'];
			$this->tax_hierarchical = isset($args['hierarchical']) ? $args['hierarchical'] : false;

			$this->addTaxonomy();
		}

		private function addTaxonomy(){
			$taxonomy = array();
			$name = $this->tax_name;
	        $txtdomain = $this->tax_txtDomain;
	        //Country Taxonomy
	        $taxonomy = array(
	            'hierarchical' => $this->tax_hierarchical,
	            'query_var' => $this->tax_id,
	            'rewrite' => array(
	                'slug' => $this->tax_slug
	            ),
	            'labels' => array(
	                'name' => __($name, $txtdomain),
	                'singular_name' => __($name, $txtdomain),
	                'edit_item' => __('Edit ' . $name, $txtdomain),
	                'update_item' => __('Update ' . $name, $txtdomain),
	                'add_new_item' => __('Add ' . $name, $txtdomain),
	                'new_item_name' => __('Add New ' . $name, $txtdomain),
	                'all_items' => __('All ' . $name, $txtdomain),
					'search_items' => __('Search ' . $name, $txtdomain),
					'popular_items_with_comments' => __('Separate ' . $name . ' with commas', $txtdomain),
					'add_or_remove_items' => __('Add or Remove ' . $name, $txtdomain),
					'choose_from_most_used' => __('Choose from most used ' . $name, $txtdomain)
	            )
	        );

	        
	        register_taxonomy($this->tax_id, $this->tax_cpostType, $taxonomy);
		}
	}
}
?>