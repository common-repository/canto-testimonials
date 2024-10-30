<?php
/*
 *  Plugin Name: Canto Testimonials
 *  Plugin URL: http://www.CantoThemes.com
 *  Description: Canto Testimonials simple and effective testimonials shortcode.
 *  Author: CantoThemes.com
 *  Version: 1.0
 *  Author URI: http://www.CantoThemes.com
 *  Text Domain: cantoTestimonials
 *  License:     GPL-2.0+
 *  License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
define("CANTO_TESTIMONIALS_V", '1.0');
define("CANTO_TESTIMONIALS_PATH", plugin_dir_path(__FILE__));
define('CANTO_TESTIMONIALS_URL', plugin_dir_url( __FILE__ ));
define("CANTO_TESTIMONIALS_TXTDOMAIN", 'cantoTestimonials');


require_once( CANTO_TESTIMONIALS_PATH . 'lib/custom.post.class.php' );
require_once( CANTO_TESTIMONIALS_PATH . 'lib/custom.metabox.class.php' );

add_action('init', 'canto_testimonials_post_type');

function canto_testimonials_post_type(){


    //Testomonial post type
    if( class_exists('Canto_CustomPostType') && class_exists('Canto_CustomMetaBox') ){
        $testomonials_cptype = array(
            'postType' => 'Testimonials',
            'txtdomain' => CANTO_TESTIMONIALS_TXTDOMAIN,
            'postTypeDesc' => 'Describe about your service.',
            'postTypePublic' => false,
            'pTypePShowUI' => true,
            'pTypeSupport' => array(
                'title',
                'excerpt'
            ),
            'pTypeRewrite' => false
        );
        $testomonials = new Canto_CustomPostType($testomonials_cptype);

        $client_company_metabox =  array(
            'id' => 'client_company_metabox',
            'name' => 'Company',
            'nameType' => 'Name',
            'cPostType' => $testomonials->getPostType(),
            'TxtDomain' => $testomonials->getTxtDomain(),
            'InputTypes' => 'text',
            'placeholder' => 'ex. CantoThems'
        );
        $client_company = new Canto_CustomMetaBox($client_company_metabox);

        $client_pos_metabox =  array(
            'id' => 'client_pos_metabox',
            'name' => 'Position',
            'nameType' => 'Slug',
            'cPostType' => $testomonials->getPostType(),
            'TxtDomain' => $testomonials->getTxtDomain(),
            'InputTypes' => 'text',
            'placeholder' => 'ex. CEO'
        );
        $client_pos = new Canto_CustomMetaBox($client_pos_metabox);
    }


}

/*
 * Register Theme css codes
 */
add_action('wp_print_styles','canto_testimonials_styles');
function canto_testimonials_styles()
{
    global $wp_styles;

    wp_register_style( 'jquery-bxslider', CANTO_TESTIMONIALS_URL . 'css/jquery.bxslider.css', array(), time(), 'all');
    wp_register_style( 'canto-testimonials', CANTO_TESTIMONIALS_URL . 'css/canto_testimonials.css', array(), time(), 'all');

    wp_register_style( 'canto-font-awesome', CANTO_TESTIMONIALS_URL . 'css/font-awesome.min.css', array(), time(), 'all' );
    wp_register_style( 'canto-font-awesome-ie7', CANTO_TESTIMONIALS_URL . 'css/font-awesome-ie7.min.css', array(), time(), 'all' );
    $wp_styles->add_data( 'canto-font-awesome-ie7', 'conditional', 'lte IE 7' );
}


/*
 * Register Theme css codes
 */
add_action('wp_print_scripts','canto_testimonials_scripts');
function canto_testimonials_scripts()
{
    // front-end css
    wp_register_script( 'jquery-bxslider', CANTO_TESTIMONIALS_URL . 'js/jquery.bxslider.min.js', array( 'jquery' ), '1.0', true);
}


if (!function_exists('canto_testimonials_slider')) {
    function canto_testimonials_slider( $atts, $content = null ) {
        $default = array(
            'count' => 3,
            'fx' => 'horizontal',
            'pager' => 0,
            'auto' => 0,
            'pause' => 2000,
            'speed' => 1000,
            'hidecontrolonend' => 1,
            'infiniteloop' => 0
        );

        $main_atts = shortcode_atts( $default, $atts );
        extract( $main_atts );

        //print_r($main_atts);

        // Widget Content
        //wp_reset_query();    
        $testomonials = get_posts( array('post_type'=>'testimonials', 'showposts'=> $count));

        $output = '';

        //print_r($testomonials);
        wp_enqueue_style( 'jquery-bxslider');
        wp_enqueue_style( 'canto-testimonials');
        wp_enqueue_style( 'canto-font-awesome');
        wp_enqueue_style( 'canto-font-awesome-ie7');

        wp_enqueue_script( 'jquery-bxslider');

        $infiniteloop = ($hidecontrolonend) ? 0 : $infiniteloop ;
        $auto = ($hidecontrolonend) ? 0 : $auto ;

        $output .= '<div class="testimonials-slider bxslider" data-fx="'.$fx.'" data-pager="'.$pager.'" data-speed="'.$speed.'" data-hidecontrolonend="'.$hidecontrolonend.'" data-infiniteloop="'.$infiniteloop.'" data-auto="'.$auto.'" >';
        foreach ($testomonials as $testomonial) {
            $output .= '<div>';
                $output .= '<blockquote>';
                    $output .= $testomonial->post_excerpt;
                    $output .= '<strong>';
                        $output .= $testomonial->post_title;
                    $output .= '</strong><small>';
                        $output .= get_post_meta($testomonial->ID, 'client_pos_metabox', true) . ', ' . get_post_meta($testomonial->ID, 'client_company_metabox', true);
                    $output .= '</small>';
                $output .= '</blockquote>';
            $output .= '</div>';
        }
        $output .= '</div>';

        return $output;
    }
    add_shortcode('canto_testimonials_slider', 'canto_testimonials_slider');
}
?>