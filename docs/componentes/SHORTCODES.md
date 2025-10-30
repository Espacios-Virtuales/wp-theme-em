# 🧩 Shortcodes Standalone – EVAAS Theme

**Versión:** 1.0.0
**Fecha:** October 2025

---


## Ejemplo básico

```php
add_shortcode('ev-cardgrid', function($atts){
    wp_enqueue_style('ev-cardgrid', get_template_directory_uri().'/assets/css/ev-cardgrid.css');
    wp_enqueue_script('ev-cardgrid', get_template_directory_uri().'/assets/js/ev-cardgrid.js', ['jquery'], null, true);
    include locate_template('inc/components/ev-cardgrid/ev-cardgrid.php');
});
```
