## What are controllers?
Controllers are classes that inherit from a `BaseController` that are used to handle certain part of your app's functionality. For example, the `home` controller might handle all the static pages, the `user` controller handles all the user interactions, and so on.

## How are controller called
Controllers are called by the routes you have previously defined in your router. For example, if you have the route `Router::route('GET', '/', 'home#index')`, sloth-php will attempt to call the method `index` in the `home` controller.

## How controllers are built
When a route is accessed, it will create a new instance of your controller. So your controller needs all the methods that your routes link to of course, but can also contain its own sub methods.  
To show an example of this, we're going to build said "home" controller here:

```
  class HomeController extends BaseController {

    public function index(){
      View::render('home');
    }

    public function some_misc_funtion(){
      // I do pretty cool stuff. Really!
    }

  }
```


*more stuff down here soon*