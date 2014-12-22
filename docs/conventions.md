## A quick word about the concept
Sloth-php is an extremely simplified approach of an MVC framework. Where a normal MVC framework usually consists of (M)odels, (C)ontrollers and (V)iews (and Routing), sloth-php only gives you very simple controller and view scaffolding as well as routing.   
**Now, why is that?**
Basically, MVC concepts are great to keep your application tidy in large scale. For smaller things, the whole model relation concept can be a bit of an overkill though. So sloth-php is focused on strict RESTful routing that allows you to handle any type of interaction but only loosely structured with controllers and views behind it.

## Sloth-php structure
```
├───app
│   ├───controllers
│   ├───models
│   └───views
│   └───router.php
│   └───config.php
├───core
└───docs
├───public
├───vendor
└───index.php
```

- `app` Directory for your custom application code
 - `controllers` Your app controllers
 - `models` Your app models
 - `views` Your app views
 - `router.php` Holds your app's routes
 - `config.php` Holds your app's global config
- `core` - The sloth-php framework core
- `docs` - The sloth-php documentation files
- `public` - Your css and js files
- `vendor` - Third-party css and js files
- `index.php` - Framework entrance point


## File naming conventions
- Controllers: `app/controllers/` + `name_controller.php`
- Models: `app/models/` + `name.php`
- Views: `app/views/` + `name.php`
