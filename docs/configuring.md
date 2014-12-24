## Configuring sloth-php
Actually, you don't have to configure a lot on the framework itself in order for it to run. However, sloth-php offers you an `app/config.php` file that you can use to store global config values.
If your app is using a database connection, you will have to save its server information in this config as well.   
**The only important thing is:** You need to adjust the `APPDIR` and `SUBDIR` constants in the index.
- `APPDIR` The name of your app directory. `app` works fine. If you want to change it, feel free to do so and rename your app folder.
- `SUBDIR` The subdirectory under your domain. Running sloth-php under `domain.com/my_project/` would require you to set `/my_project/` as subdir, so that sloth-php can create correct relative paths for your files. Otherwise this might cause random errors!!


## So, what does this do?
Every part of sloth-php inherits from its `Base` which itself contains a `config` property that holds all the values you configured. You can access any property you define in the config array with `static::config('key')` or `Base::config('key')`.  
Simple as that.

## Example
This example is a controller method that loads the `framework` config value into the registry to display it on the rendered view.

*app/controllers/Home.php*
```
class Home {
  public function index(){
    Registry::set("Framework", static::config('framework'));
    
    View::render('home');
  }
}
```


*app/views/home.php*
```
<html>
<head>
  <title><?php __('Framework') ?></title>
</head>
<body>

  You're using <?php __('Framework') ?>

</body>
</html>
```