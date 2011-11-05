Zend Content Management Framework
===
This repository is the location for Zcmf (a temporary name wich will change soon).
The content management framework is built on top of the Zend Framework 2 with
several modules to provide an easy to use platform to develop Mvc applications
with an admin backend.

Theory of operation
---
The system works with a database where pages are stored. A page is a representation
of a module at a specific location in the tree of pages ("sitemap"). This makes
it possible to have multiple text pages for example with all different content
using only one module providing the text pages.

A page has a link to a module and gives the module a (unique) module identifier.
The identifier can be set by the module upon creation of the page, to know what
content should be loaded when the page is requested. The module provide parts of
routes which will form together with the route parts of the page the complete
route. As an example:

*A blog page has as route `blog` and the blog module has `article/:id` as one
of the routes. This will be parsed to a route `blog/article/:id` and injected
into the router.*

A module can provide multiple routes by using the `Zend\Mvc\Router\Route\Part`
route.

Admin interface
---
Several modules might want to have a backend for a user to edit the content of
the pages. For this usage is an Admin module. The admin module provides access
to the application settings, user settings and some more. However, the most
important function for the admin module is to serve as a proxy for the modules
to edit the content.

-- how to TBD --