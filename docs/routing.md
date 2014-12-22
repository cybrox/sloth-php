## Concepts of restful routing
sloth-php includes a full restful routing concept that allow you to trigger different actions based on the http request url and request type it is accessed. There are two essential parameters for routing:  
- The http request type (*verb*)
- The http request url


## Rewriting your URLs
sloth-php assumes that all requests use `/index.php` as entry point, so you will need to configure your server to redirect all requests to the framework directory to `index.php`. If you're using Apache, you can simply leave the `.htaccess` file from this repository as it is and it will automatically rewrite all requests to `index.php`. If you're using nginx or any other type of webserver, you might need to set a config value to achieve this.


## Setting up your router
The first thing you want to do when creating an application using sloth-php is setting up your router, so that incoming requests are handled by the framework and you can get some actual output.  
All changes noted here should be done in your `app/router.php` file.  
If you're running a project with sloth-php in a subdirectory of your domain, you need to setup the router base in order for it to match url's correctly.

```
// For example, your project is located under domain.com/projects/sloth_get_cake
Router::set_base("projects/sloth_gets_cake/");

// If your project is not nested in a sub directory, you don't
// need to use set_base. But you can technically do this:
Router::set_base("/");
```


## Creating routes
A sloth-php route needs 3 parameters:
- The http access verb you want to match (`GET`, `POST`, `PUT` ...)
- The path you want to match (`/`, `/about`, ...)
- The controller-method you want to handle that request. (`controller#method`)

The following examples show some simple routes you could use.
```
// This would match your home page (GET domain.com)
Router::route("GET", "/", "home#index");

// This would match your about page (GET domain.com/about)
Router::route("GET", "/about", "home#about");

// This would match a user index page (GET domain.com/users)
Router::route("GET", "/users", "user#index");

// This would handle a post request to the users page
Router::route("POST", "/users", "user#create");
``` 


## Before and after route hooks
sloth-php allows you to set hooks that will be executed before and after calling the controller method specified in the route. This can be useful if you want to authenticate a user before accessing a page or log user data after the route itself was progressed

```
// This hook will be run before calling home#index (the route defined above)
// It will call the method "before_index" of the "home" controller
Router::route_before("GET", "/", "home#before_index");

// This hook will be run after calling home#index
// In this case, we're using a lambda (anonymous function)
Router::route_after("GET", "/", function(){ echo 'bye bye'; });
```

As you can see, the `route_before` and `route_after` hook can either take a *controller#method* string like the route itself or an anonymous function (*lambda*) if you just want to do some really basic stuff.