=== Canto Testimonials ===
Contributors: rajuahmmedbd
Donate link: 
Tags: shortcode, testimonials, testimonials slider
Requires at least: 3.0
Tested up to: 3.7
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

Canto Testimonials simple and effective testimonials shortcode. It's interrogated with BxSlider.

== Description ==

Canto Testimonials simple and effective testimonials shortcode. It's interrogated with BxSlider.

= Shortcode =
	[canto_testimonials_slider]

= Attributes List: =
* count (int): Amount of Testimonials at slider. `Default: 3`

* fx (string): Type of transition between slides. `Default: 'horizontal'`

	`Options: 'horizontal', 'vertical', 'fade'`
* pager (bool): If 1 (true), a pager will be added. `Default: 0`

	`Options: '0 - False', '1 - True'`
* auto (bool): If 1 (true), Slides will automatically transition. If 'hidecontrolonend' is 1 (true), This option not will be work. `Default: 0`

	`Options: '0 - False', '1 - True'`
* pause (int): The amount of time (in ms) between each auto transition. `Default: 2000`
* speed (int): Slide transition duration (in ms). `Default: 1000`

* hidecontrolonend (bool): If 1 (true), "Next" control will be hidden on last slide and vice-versa. `Default: 1`

	`Options: '0 - False', '1 - True'`
* infiniteloop (bool): If 1 (true), Slides will automatically transition. If 'hidecontrolonend' is 1 (true), This option not will be work. `Default: 0`

	`Options: '0 - False', '1 - True'`
= Example =
	[canto_testimonials_slider]
	[canto_testimonials_slider pager=1]
	[canto_testimonials_slider pause=1500]
	[canto_testimonials_slider fx="fade" hidecontrolonend=0]
== Installation ==

= Install the Plugin =

 Full instruction of this plugin installation

 e.g.

 1. Upload `canto-testimonials` to the `/wp-content/plugins/` directory
 2. Activate the plugin through the 'Plugins' menu in WordPress
 3. Now Add testimonials and add shortcode at widget, page and post.

== Frequently Asked Questions == 

= What is Canto Testimonials? =

Canto Testimonials plugin for clients testimonials.