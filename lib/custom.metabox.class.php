<?php
if (!class_exists('Canto_CustomMetaBox')) {
	class Canto_CustomMetaBox{
		//Properties
		private $mbox_name = '';
		private $mbox_name_type = '';
		private $mbox_id = '';
		private $customPType = '';
		private $thTxtDomain = '';
		private $iType = '';
		private $placeholder = '';


		/*
		 * MetaBox ID
		 * MetaBox Name
		 * Custom Post Type
		 * Text Domain
		 * Input Type
		 */

		//Constrator Method
		function __construct($args = array()){
			//Set properties value
			$this->mbox_id = strtolower($args['id']);
			$this->mbox_name = strtolower($args['name']);
			$this->mbox_name_type = strtolower($args['nameType']);
			$this->customPType = strtolower($args['cPostType']);
			$this->thTxtDomain = $args['TxtDomain'];
			$this->iType = $args['InputTypes'];
			$this->placeholder = isset($args['placeholder']) ? $args['placeholder'] : '';

			$this->addActionToAddMetabox();
		}

		//Add action to add metabox
		private function addActionToAddMetabox(){
			add_action('add_meta_boxes', array(&$this, 'addMetabox'));
			add_action('save_post', array(&$this, 'saveMyData'));
		}

		//Add metabox
		public function addMetabox(){
			add_meta_box($this->mbox_id, __(ucwords($this->mbox_name), $this->thTxtDomain), array(&$this, 'metaboxUI'), $this->customPType);
			
		}

		public function metaboxUI($post){
			$savedData = get_post_meta($post->ID, $this->mbox_id, true);
			?>
			<p>
			    <label for="<?php echo $this->mbox_id;?>"><?php echo ucwords($this->mbox_name_type);?>: </label>
			    <input type="<?php echo $this->iType;?>" class="widefat" name="<?php echo $this->mbox_id;?>" id="<?php echo $this->mbox_id;?>" value="<?php echo esc_attr($savedData); ?>" placeholder="<?php echo $this->placeholder; ?>" />
			</p>
			<?php
		}

		public function saveMyData($id){
			if(isset($_POST[$this->mbox_id])){
	            update_post_meta(
	                    $id,
	                    $this->mbox_id,
	                    strip_tags($_POST[$this->mbox_id])
	                    );
	        }
		}
	}
}

?>