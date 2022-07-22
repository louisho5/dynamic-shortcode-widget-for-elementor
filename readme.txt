=== Dynamic Shortcode Widget for Elementor ===
Tags: shortcode builder, shortcode widget, dynamic shortcode, shortcode editor, page builder, editor, drag-and-drop, visual editor, website builder, elementor, wysiwyg
Tested up to: 6.0
Stable tag: 0.1.0
Contributors: louisho5

Dynamic Shortcode Widget for Elementor plugin let you to add custom shortcode with simple input field.

== Description ==

Dynamic Shortcode Elementor provides an easy to use interface for managing attributes for your shortcode.

= Dynamic Shortcode Widget Codes =

Why you have to install create such many custom shortcodes in elementor for your client.. and use it so confused like [MyShortcode name="John Doe" slogan="&qout;Simplicity is king&qouts;"]

With Dynamic Shortcode Widget for Elementor plugin you can just copy the shortcode name, each attributes and its data to manage them all.. And now you can input your content like wysiwyg editor, you don't need to concern the html escape in your shortcode any more.

= Limits =

This plugin does not support enclosing shortcode!

== Installation ==

1. Put the plugin folder into [wordpress_dir]/wp-content/plugins/
2. Go into the WordPress admin interface and activate the plugin
3. Optional: go to the options page and configure the plugin

== Frequently Asked Questions ==

##### How to create a custom shortcode
`````
function custom_shortcode( $atts ) {
    $attributes  = shortcode_atts( array(
      'name' => 'world'
    ), $atts );
    return '<h1>Hello ' . $attributes['name'] . '!</h1>';
}
add_shortcode( 'helloworld', 'custom_shortcode' );
`````

##### How to use the shortcode
`````
Shortcode: [helloworld]
Outputs "Hello world!"

Shortcode: [helloworld name=”Bob”]
Outputs "Hello Bob!"
`````

== Changelog ==

= 0.1.0 =

* Plugin announced
* Options for the type of input fields

== Privacy and GDPR ==

This plugin does not collect or process any personal user data.