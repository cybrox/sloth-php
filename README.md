# sloth-php
![A sloth](http://i.huffpost.com/gen/1164733/thumbs/o-PHOTOS-OF-SLOTHS-facebook.jpg)  
So you're looking for a simple php framework? Tell me more about how simple it should be.

----

### What is sloth-php?
Sloth-php is a php framework that was designed to be as simple and minimalistic as possible.  
I've been working with php a lot over the past few years and I've often ran into situations, where I wanted to build a really small tool but was too lazy to build the underlying concepts over and over every time. After searching for small php frameworks, I've certainly found some good projects but thought they were pretty simple, they tend to be still a bit bloated or bad documented.   
So instead of working into something new, I decided to just write something simple that I can personally use for small projects and document it to make it available for everybody.

### Documentation and stuff
- [Structure and naming conventions](https://github.com/cybrox/sloth-php/blob/master/docs/conventions.md)
- [Configuring `app/config.php`](https://github.com/cybrox/sloth-php/blob/master/docs/configuring.md)
- [Matching Routes `app/router.php`](https://github.com/cybrox/sloth-php/blob/master/docs/routing.md)
- [Building Controllers `app/controllers`](https://github.com/cybrox/sloth-php/blob/master/docs/controllers.md)
- [Rendering Views `app/views`](https://github.com/cybrox/sloth-php/blob/master/docs/views.md) *soon*
- [Creating Models `app/models`](#) *soon*
- [Database Interactions](#) *soon*


### Project goals
- [x] Restful routing
 -  [x] Allow user to set routes in the application
 -  [x] Use lambda-functions for before/after route hooks
 -  [x] Pass controller#method strings to defined lambdas
- [x] Controller actions linked to handle a route
 -  [x] Link a specific route to a controller action
 -  [x] Determine action based on requested format (html/json)
- [x] Rendering views
 -  [x] Render views based on the method called in the controller
 -  [x] Default view scaffolding for json replies
 -  [x] *Preload* storage for temp value storage between controller and view
-  [x] Models
 -  [x] Database connectors and handlers
 -  [x] Query builder
 -  [x] App model system to access from controllers
-  [ ] Error handling
 -  [x] Catch errors and route to a custom error handling
 -  [x] Proper default error routes
- [x] Session handling
 - [x] Simple global session handling
- [ ] Full documentation of these few concepts
