# sloth-php
![A sloth](http://i.huffpost.com/gen/1164733/thumbs/o-PHOTOS-OF-SLOTHS-facebook.jpg)  
So you're looking for a simple php framework? Tell me more about how simple it should be.

----

### What is sloth-php?
Sloth-php is a php framework that was designed to be as simple and minimalistic as possible.  
I've been working with php a lot over the past few years and I've often ran into situations, where I wanted to build a really small tool but was too lazy to build the underlying concepts over and over every time. After searching for small php frameworks, I've certainly found some good projects but thought they were pretty simple, they tend to be still a bit bloated or bad documented.   
So instead of working into something new, I decided to just write something simple that I can personally use for small projects and document it to make it available for everybody.

### Documentation and stuff
*coming soon*

### Project goals
- [ ] Restful routing
 -  [x] Allow user to set routes in the application
 -  [x] Use lambda-functions for before/after route hooks
 -  [ ] Pass controller#method strings to defined lambdas
- [ ] Controller actions linked to handle a route
 -  [x] Link a specific route to a controller action
 -  [ ] Determine action based on requested format (html/json)
- [ ] Rendering views
 -  [ ] Render views based on the method called in the controller
 -  [ ] Default view scaffolding for json replies
 -  [ ] *Preload* storage for temp value storage between controller and view
 -  [ ] *Controller* storage for accessing loaded model information in a view
-  [ ] Models
 -  [ ] Database connectors and handlers
 -  [ ] Query builder
 -  [ ] App model system to access from controllers
 -  [ ] Simple relations between models?
-  [ ] Error handling
 -  [x] Catch errors and route to a custom error handling
 -  [ ] Display nice error response
 -  [ ] Proper default error routes
- [ ] Session handling
 - [ ] Simple global session handling
- [ ] More?