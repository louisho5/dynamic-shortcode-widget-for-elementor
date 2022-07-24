# Dynamic Shortcode Widget for Elementor
### Easy WordPress Shortcode Interface

Dynamic Shortcode Widget for Elementor plugin let you to add custom shortcode with simple input field. It provides an easy to use interface for managing attributes for your shortcode.

Get started at http://wordpress.org/plugins/dynamic-shortcode-widget-for-elementor/

## Screenshot
 ![alt Shortcode Widget](https://raw.githubusercontent.com/louisho5/dynamic-shortcode-widget/main/image/screenshot.png)

## Frequently Asked Questions

##### How to create a custom shortcode
```php
function custom_shortcode( $atts ) {
    $attributes  = shortcode_atts( array(
      'name' => 'world'
    ), $atts );
    return '<h1>Hello ' . $attributes['name'] . '!</h1>';
}
add_shortcode( 'helloworld', 'custom_shortcode' );
```

##### How to use the shortcode
```
Shortcode: [helloworld]
Outputs "Hello world!"

Shortcode: [helloworld name=”Bob”]
Outputs "Hello Bob!"
```

## License
- The plugin is licensed under the GPLv2 or later:
  - http://www.gnu.org/licenses/gpl-2.0.html

## Changelog
- v0.1.0
  - Plugin announced
  - Added image option for the type of input fields
