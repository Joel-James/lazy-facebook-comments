# Lazy FB Comments
Plugin to lazy load Facebook comments after clicking a button. A simple comment plugin which will **replace** the deafult WordPress commenting system with improved FB comments.

<hr/>

##### Contributors: <a href="https://github.com/joel-james/">Joel James</a>
##### Requires at least: WordPress 3.0
##### Tested up to: WordPress 4.9
##### Stable tag: 2.0.3

### Adding Custom Post Support

To add custom post support use `lfc_supported_post_types` filter.

```
add_filter( 'lfc_supported_post_types', 'mycustom_add_lfc_cpt_support', 5 );

function mycustom_add_lfc_cpt_support( $post_types ) {
    // Here mycpt is your custom post type name.
    $post_types[] = 'mycpt';

    return $post_types;
}
```