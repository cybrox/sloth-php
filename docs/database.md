## Where should I do this?
sloth-php follows the MVC conecpt, which means that every Model class represents a table in the database. The framework does not handle records but instead build prepared statements via a query builder in order to get the data you want. Per default, the framework will try to match your model class name to a database table. For example the model `User` would get the database table `user`. If you want to use a different table, set the static table property `public static $table` in your model. Alternatively, you could user `public static $no_table = true;` to disable database interactions for this model.


## Building queries.
Essentially, sloth-php gives you three ways to build queries:  
- Via query object.
  - Call `Model::query()`. You will get a query object with the model's table as entry point that you can modify and evaluate using the methods listed below.

- Via first selection
  - You can directly implement a query piece in the process of getting the query to shorten things a bit. So instead of `Model::query()`, you use `Model::where('x', '=', 'y')`. This will return a query object as well but with already executed where method. All query objects methods are mapped to static methods in the model itself unless you overwrite them with custom methods.

- Via model class
 - This is not really a solution but due to the fact that all query actions are mapped to the model as static methods, you could also just call them all from the model object like so. `Model::where('x', '=', 'y');`, `Model::count()`