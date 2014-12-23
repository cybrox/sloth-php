## What are views?
Views are what the user actually gets as a response when requesting your page. The sloth-php router calls a controller method and this itself will call a View-render method to display a page or output data in *json* format.


## How to render views
There are multiple ways to render a view from the controller:  
- `View::render(name)`
 - This will render the view *name* between the header and footer view. sloth-php assumes that you have a `view/header.php` and `view/footer.php` that surround your rendered view as *static* pieces. If you want to use other templates as header/footer wrapper, you can change them by calling `View::set_header(name)` or `View::set_footer(name)`

- `View::render_partial(name)`
 - This does basically the same as `View::render` but it does not include the header and footer views. If you call `render_partial`, sloth-php will only render that single view.

- `View::render_json(data)`
 - This will output the given data in json format with the respective header. You can pass either a data array that will be serialized to json data or a json string that will be outputted directly.


**Please note:** Each of these three methods also take an optional second parameter. If you set it to true, it will execute `Router::terminate()` after outputting your view/json. This is useful for error handling.

## The registry
The `Registry` is a buffer sloth-php uses to make templating easy for you. You can load values into the registry inside your controller by using `Registry::set("key", "value");` and output or use them in your template. sloth-php offers you the shortcut method `__` to quickly output Registry elements in your template by simply writing `<?php echo __('key'); ?>`

## Linking
While you can certainly use normal `a` tags for linking in your views, to prevent links from breaking due to url reqwrite, you might want to use the Router's link helper. `<a href="<?php echo Router::link("/users") ?>">Users</a>`

## Autoloading scripts and styles
You can automatically generate the embed tags for your scripts and styles in `/public` and `/vendor` by using `<?php Autoloader::load_public(); ?>` or `<?php Autoloader::load_vendor(); ?>` in your header template.