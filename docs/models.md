## What are models?
In normal MVC concepts, models represent a certain table with its datasets that you can connect, rely and interact with other models. For sloth-php, models are pretty much just group of functions. Since sloth-php is aimed to be used for really simple stuff, I skipped all the model relation ideas and models are just straightforward implemented classes.

## How to create models
Models belong into the `app/models` directory. The way I prefer to use these model-like-classes for simple applications, is using them as static method holders. So for example the model `Sloth` in `app/models/sloth.php` has a method `count_sloths()` which will execute a database query to count all sloths in the database ([Read more about this here]() *soon*) and simply return this value.

This way, *models* here just hold *all the database interaction thingies* and are not actual MVC models.