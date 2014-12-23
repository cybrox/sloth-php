## What are models?
In sloth-php, A model represents a table in your database. The framework will try to automatically guess your table. For example the model `Sloth` will try to access the `sloth` table. However, you can manually set a table in your model by with the following variables:
- `public static $table` Table of your model
- `public static $no_table = true` Disable db access for this model

## How to create models
Models belong into the `app/models` directory. The way I prefer to use these model-like-classes for simple applications, is using them as static method holders. So for example the model `Sloth` in `app/models/sloth.php` has a method `count_sloths()` which will execute a database query to count all sloths in the database ([Read more about this here]() *soon*) and simply return this value.

This way, *models* here just hold *all the database interaction thingies* and are not actual MVC models.