=== Dynamic Shortcode Widget for Elementor ===
Tags: shortcode builder, shortcode widget, dynamic shortcode, shortcode editor, page builder, editor, drag-and-drop, visual editor, website builder, elementor, wysiwyg, elementor addons, elementor extensions,  elementor modules, elementor templates
Tested up to: 6.3
Stable tag: 0.3.1
Contributors: louisho5

Dynamic Shortcode Widget for Elementor plugin let you to add custom shortcode with simple input field.

== Description ==

Dynamic Shortcode Elementor provides an easy to use interface for managing attributes for your shortcode.

= What is Dynamic Shortcode Widget =

Why you have to use your custom shortcodes so confused like [MyShortcode name="John Doe" slogan="&amp;quot;Simplicity is king&amp;quot;"]

With Dynamic Shortcode Widget for Elementor plugin you can just copy the shortcode name, attributes and its data to manage them all.. And now you can input your content in textarea or select your image from the media gallery. Also, you are no longer to concern about the html escape in your shortcode start from today.

You may find more on [Github](https://github.com/louisho5/dynamic-shortcode-widget-for-elementor)

= Limits =

This plugin does not support enclosing shortcode!

== Installation ==

1. Put the plugin folder into [wordpress_dir]/wp-content/plugins/
2. Go into the WordPress admin interface and activate the plugin
3. Optional: go to the options page and configure the plugin

== Frequently Asked Questions ==

##### How to create a custom shortcode
```
function custom_shortcode( $atts ) {
    $attributes  = shortcode_atts( array(
      'name' => 'world'
    ), $atts );
    return '<h1>Hello ' . $attributes['name'] . '!</h1>';
}
add_shortcode( 'helloworld', 'custom_shortcode' );
```

##### How to use the shortcode

Shortcode: [helloworld]
Outputs "Hello world!"

Shortcode: [helloworld name=”Bob”]
Outputs "Hello Bob!"

== Screenshots ==

1. Widget on elementor

== Changelog 

= 0.3.0 =

* Added WYSIWYG option for the type of input fields

= 0.2.1 =

* Escape only with qoute characters instead of html

= 0.2.0 =

* Added URL option for the type of input fields

= 0.1.0 =

* Plugin announced
* Options for the type of input fields

== Privacy and GDPR ==

This plugin does not collect or process any personal user data.
