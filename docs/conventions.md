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
- `index.php` - Framework entrance point


## File naming conventions
- Controllers: `app/controllers/` + `NameController.php`
- Models: `app/models/` + `name.php`
- Views: `app/views/` + `name.php`
